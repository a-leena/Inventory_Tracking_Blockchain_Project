pragma solidity ^0.4.21;
import"./Manager.sol";
//import"./Escrow.sol";
 contract distributor is main //, escrow
 {

    event OrderRecievedAndAccepted(uint orderId);

    function orderRecievedAndAccepted (uint orderId) public {

        require(msg.sender==flowOfObject[orderId].Addresses[currentaddress[orderId]]);
        statsMap[orderId].checkPoint="OrderReceivedByDistrubutor"; // Updates currentStatusOfOrder.
        statsMap[orderId].timeTheEventCalled=now;
        //payBalance(orderId);
        emit OrderRecievedAndAccepted(orderId);
    }
 }
