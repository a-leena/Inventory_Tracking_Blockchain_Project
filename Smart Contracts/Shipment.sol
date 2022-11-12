pragma solidity ^0.4.21;
import "./Manager.sol";

contract shipmentTracking is main {

    event DepartedFromOnePort(uint shipmentId);
    event ArrivedAtAnotherPort(uint shipmentId);

    //uint shipmentId;
    uint orderId;

    function stateRequiredTimeToNextEntity(uint _orderId, uint _requiredTime) public{ // Give Estimate;

        statsMap[_orderId].timeToNextEntity = _requiredTime;
    }

    function arrived(uint shipmentId) public
    {
        require(msg.sender==flowOfObject[orderId].Addresses[currentaddress[orderId]]);
        statsMap[orderId].checkPoint="ArrivedAtNearestPort";    //Updates currentStatusOfOrder.
        statsMap[orderId].timeTheEventCalled=now;
        transferPossesion(orderId);
        emit ArrivedAtAnotherPort(shipmentId);
    }

    function departured(uint shipmentId) public
    {
        statsMap[orderId].checkPoint="DepartedFromThePort";     //Updates currentStatusOfOrder.
        statsMap[orderId].timeTheEventCalled=now;
        emit DepartedFromOnePort(shipmentId);
    }

    function shipped (uint _orderId, uint _requiredTime) public {
        stateRequiredTimeToNextEntity(_orderId, _requiredTime);
        uint shipmentId = itemMap[_orderId].shipmentId;
        departured(shipmentId);
        arrived(shipmentId);
    }
}
