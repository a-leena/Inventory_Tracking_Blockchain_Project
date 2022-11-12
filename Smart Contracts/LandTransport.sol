pragma solidity 0.4.21;
import "./Manager.sol";

contract landTransport is main {

// Defined Events
event OrderLoaded(uint _orderId);
//event OrderInTransit(uint _orderId);
event OrderUnloaded(uint _orderId);

function orderLoaded(uint _orderId) public
{
    require(msg.sender==flowOfObject[_orderId].Addresses[currentaddress[_orderId]]);
    statsMap[_orderId].checkPoint="OrderLoadedByLandTransport"; // Updates currentStatusOfOrder.
    statsMap[_orderId].timeTheEventCalled=now;
    emit OrderLoaded(_orderId);  // Event OrderLoaded.
 }

function stateRequiredTimeToNextEntity (uint _orderId, uint _requiredTime) public{  // Give Estimate;
  statsMap[_orderId].timeToNextEntity = _requiredTime;
}

function orderUnloaded(uint _orderId) public
{
    statsMap[_orderId].checkPoint="OrderUnloadedByLandTransport"; // Updates currentStatusOfOrder
    statsMap[_orderId].timeTheEventCalled=now;
    emit OrderUnloaded(_orderId);
    transferPossesion(_orderId);
 }

 function transported (uint _orderId, uint _requiredTime) public {
  orderLoaded(_orderId);
  orderUnloaded(_orderId);
  stateRequiredTimeToNextEntity(_orderId, _requiredTime);
}


}
