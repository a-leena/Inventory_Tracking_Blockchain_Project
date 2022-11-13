pragma solidity ^0.4.21;
 import "./Manager.sol";
 import "./LandTransport.sol";
 import "./Distributor.sol";
 import "./Escrow.sol";
 import "./Customs.sol";
 import "./PortAuthority.sol";
 import "./Shipment.sol";
 contract manufacturer is main, landTransport, distributor, customs, portAuthority, shipmentTracking  {
      event OrderConfirmed(uint _orderId);
      event OrderManufactured(uint _orderId);
      event OrderDispatched(uint _orderId);
      event DelayInManufacturing(uint _orderId, uint _delayTime);

    function TotaltimeRequired(uint orderId, uint _TotaltimeRequired, uint _expectedTimeOfDeparture) public {

        itemMap[orderId].totalTimeRequired = now + _TotaltimeRequired; // total time required for whole process.
        statsMap[orderId].timeToNextEntity = now + _expectedTimeOfDeparture; // total time required to transfer to next entity.
    }


    function orderConfirmed(uint orderId) public {
        require(msg.sender==flowOfObject[orderId].Addresses[currentaddress[orderId]]);
        require(bankConfirmation[orderId]==true);
        statsMap[orderId].checkPoint="OrderConfirmed"; // Updates currentStatusOfOrder.
        statsMap[orderId].timeTheEventCalled=now;
        emit OrderConfirmed(orderId);   // Event of OrderConfirmed.
    }

    function orderManufactured(uint orderId) public {
        require(keccak256(statsMap[orderId].checkPoint)== keccak256("OrderConfirmed"));
        statsMap[orderId].checkPoint="OrderManufactured"; // Updates currentStatusOfOrder.
        statsMap[orderId].timeTheEventCalled=now;
        emit OrderManufactured(orderId);  // Event of OrderManufactured.
    }

    function orderDispatched(uint orderId, uint Weight) public {
       require(keccak256(statsMap[orderId].checkPoint)== keccak256("OrderManufactured"));
       statsMap[orderId].checkPoint="OrderDispatched";
       statsMap[orderId].timeTheEventCalled=now;  // Updates currentStatusOfOrder.
       itemMap[orderId].weight=Weight;
       emit OrderDispatched(orderId);   // Event of OrderDispatched.
       transferPossesion(orderId);
    }

    function delayInManufacturing(uint orderId, uint _delayTime) public {

        uint delayTime = _delayTime;
        statsMap[orderId].checkPoint="OrderDelayed";
        statsMap[orderId].timeTheEventCalled=now; // Updates currentStatusOfOrder.
        emit DelayInManufacturing(orderId, delayTime);  // Event of DelayInManufacturing.
    }

    function manufactured (uint orderId, uint _TotaltimeRequired, uint _expectedTimeOfDeparture, uint Weight, uint _delayTime) {
        TotaltimeRequired(orderId, _TotaltimeRequired, _expectedTimeOfDeparture);
        orderConfirmed(orderId);
        orderManufactured(orderId);
        orderDispatched(orderId, Weight);
        delayInManufacturing(orderId, _delayTime);
    }

    // Function to check currentStatusOfOrder
    function currentStatusOfOrder(uint _orderId) public returns(string, uint) {
        return(statsMap[_orderId].checkPoint, statsMap[_orderId].timeTheEventCalled);
    }
 }
