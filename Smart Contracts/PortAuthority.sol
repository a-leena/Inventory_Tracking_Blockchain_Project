pragma solidity ^0.4.21;
import "./Manager.sol";

contract portAuthority is main {   //this declares a complextype which will be used for variable later//

    event departure(uint shipmentId); //we are creating an event for export//
    event arrival(uint shipmentId);    //we are creating an event for import //

    function setshipmentId (uint orderId,uint _shipmentId) public {

        itemMap[orderId].shipmentId = _shipmentId;
    }

    function stateRequiredTimeToNextEntity(uint _orderId, uint _requiredTime) public {  // Give Estimate;

        statsMap[_orderId].timeToNextEntity = _requiredTime;
    }
    //departure
    function shipmentLoadedToShip (uint orderId) public returns (bool success)
    {
        require(msg.sender==flowOfObject[orderId].Addresses[currentaddress[orderId]]);
        emit departure(itemMap[orderId].shipmentId);
        statsMap[orderId].checkPoint="Containers loaded into the ship"; // Updates currentStatusOfOrder.
        statsMap[orderId].timeTheEventCalled=now;
        return true;
    }

    function departing(uint _orderId, uint _requiredTime) public returns (bool){
        stateRequiredTimeToNextEntity(_orderId, _requiredTime);
        return shipmentLoadedToShip(_orderId);
    }

    //arrival
    function shipmentUnloadedToPort (uint orderId) public returns (bool success)
    {
        emit arrival(itemMap[orderId].shipmentId);
        statsMap[orderId].checkPoint="Containers unloaded into the port"; // Updates currentStatusOfOrder.
        statsMap[orderId].timeTheEventCalled=now;
        transferPossesion(orderId);
        return true;
    }

    function arriving(uint _orderId, uint _requiredTime) public returns (bool){
        stateRequiredTimeToNextEntity(_orderId, _requiredTime);
        return shipmentUnloadedToPort(_orderId);
    }

}

  
