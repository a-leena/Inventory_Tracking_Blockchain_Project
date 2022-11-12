pragma solidity ^0.4.21;
import "./Manager.sol";
contract customs is main {

    event passed(uint orderId);
    event unpassed(uint orderId);
    event underweight(uint orderId);
    event overweight(uint orderId);

    // uint Weight;
    //uint Idealweight = 1500;

    //compares manager_quantity with manufacturer_quantity
    function CheckWeight(uint orderId, uint Weight) public {
         require(msg.sender==flowOfObject[orderId].Addresses[currentaddress[orderId]]);
        if(Weight == itemMap[orderId].weight)
          { statsMap[orderId].checkPoint="Product is checked by Customs"; // Updates currentStatusOfOrder.
            statsMap[orderId].timeTheEventCalled=now;
            emit passed(orderId);}
        else
            {   statsMap[orderId].checkPoint="Product Weight is not correct"; // Updates currentStatusOfOrder.
                statsMap[orderId].timeTheEventCalled=now;
                emit unpassed(orderId);
            }
    }


    //Checks wheather manufacturer_quantity is Under IdealWeight or Over IdealWeight
    function ApproveInCategory(uint orderId, uint Idealweight) public //returns(string)
    {
        if(itemMap[orderId].weight <= Idealweight)
        {   statsMap[orderId].checkPoint="Product is Approved by Customs"; // Updates currentStatusOfOrder.
            statsMap[orderId].timeTheEventCalled=now;
            emit underweight(orderId);
        }
        else
        {   statsMap[orderId].checkPoint="Product is Over Weight, Charges will be applied"; // Updates currentStatusOfOrder.
            statsMap[orderId].timeTheEventCalled=now;
            emit overweight(orderId);
        }
        transferPossesion(orderId);
    }

    function customsChecked(uint orderId, uint Weight, uint Idealweight) public {
        CheckWeight(orderId, Weight);
        ApproveInCategory(orderId, Idealweight);
    }
}
