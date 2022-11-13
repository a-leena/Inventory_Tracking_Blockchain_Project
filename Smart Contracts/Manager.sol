pragma solidity ^0.4.21;

contract main {

    struct item {            // Structure to tell about the order item which is placed;

        uint product_Id;
        uint quantity;
        uint totalCost;
        uint weight;
        uint shipmentId;
        uint totalTimeRequired;
        uint shipagent;
        address manufacturer;
        address distributor;

    }

    mapping(uint => item)public itemMap; //list items mapped to their unique orderIDs
    mapping(uint => bool)public bankConfirmation;   //boolean values mapped to each orderIDs
    mapping(uint => uint)currentaddress; // an index mapped to the orderID that tells current position in order of flow

    //  0xca35b7d915458ef540ade6068dfe2f44e8fa733c is Manager.
    //  0x14723a09acff6d2a60dcdf7aa4aff308fddc160c is manufacture.
    //  0x4b0897b0513fdc7c541b6d9d7e929c4e5364d2db is exlandtrasport.
    //  0x583031d1113ad414f02576bd6afabfb302140225 is excustoms.
    //  0xdd870fa1b7c4700f2bd7f44238821c26f7392148 is exportAuthority.
    //  0x67a9f0601ff6a156e97d864d8854efb3526336c1 is shipping.
    //  0xed7bdba6147756c5b009bac835c944d2e4f9982f is importAuthority.
    //  0x0bd9496f73ac71f9061974e17e9a6413cfdd2d2d is imcustoms.
    //  0x410acb3f8df43a9134ef769fe981a8b7c0e4d9c4 is imlandtransport.
    //  0x0063e14162a52e762257a737a0c96aa79e1202cf is distributor.
    //  0xcddb5e49b709b2e38171e36263c656e1c3bcf047 is escrow.
    //  0x0000000000000000000000000000000000000000 is notavailable.

    struct stats  {
        string checkPoint;
        uint timeTheEventCalled;
        uint timeToNextEntity;
    }

    struct AddressStruct{
        address[]  Addresses;
    }
    //for each orderID we will store a list of addresses in a particular sequence
    mapping(uint => AddressStruct) flowOfObject;

    //for each orderID we will store the status (checkpoint, time of that checkpoint, time to next checkpoint) and it will be updated as the item moves up the flow order
    mapping(uint => stats)public statsMap;

    function setOrder(uint p_Id,uint user_id,uint Quantity, uint _cost) public returns(uint ) {
       //Function to set or take the order from the Customer;
       require(msg.sender==0xca35b7d915458ef540ade6068dfe2f44e8fa733c);
       uint orderId = uint(keccak256(p_Id + Quantity + user_id));
       itemMap[orderId].product_Id = p_Id;
       itemMap[orderId].quantity = Quantity ;
       itemMap[orderId].totalCost = _cost*Quantity;
       return orderId;
    }

    function setflowoforder( uint orderId,
        address _manufacturer,
        address _exlandtrasport,
        address _excustoms,
        address _exportAuthority,
        address _shipping,
        address _importAuthority,
        address _imcustoms,
        address _imlandtransport,
        address _distributor)  public{

        //only if the function is being called by the manager (proceed)
        require(msg.sender==0xca35b7d915458ef540ade6068dfe2f44e8fa733c);

        if( _manufacturer!=0){

            flowOfObject[orderId].Addresses.push(_manufacturer);
            itemMap[orderId].manufacturer=_manufacturer;
        }
        if( _exlandtrasport!=0){

            flowOfObject[orderId].Addresses.push(_exlandtrasport);
        }
        if( _excustoms!=0){

            flowOfObject[orderId].Addresses.push(_excustoms);
        }
        if( _exportAuthority!=0){

            flowOfObject[orderId].Addresses.push(_exportAuthority);
        }
        if( _shipping!=0){

            flowOfObject[orderId].Addresses.push(_shipping);
        }
        if( _importAuthority!=0){

            flowOfObject[orderId].Addresses.push(_importAuthority);
        }
        if( _imcustoms!=0){

            flowOfObject[orderId].Addresses.push(_imcustoms);
        }
        if( _imlandtransport!=0){

            flowOfObject[orderId].Addresses.push(_imlandtransport);
        }
        if( _distributor!=0){

            flowOfObject[orderId].Addresses.push(_distributor);
            itemMap[orderId].distributor=_distributor;
        }
        flowOfObject[orderId].Addresses.push(0);
    }

    event PossesionTransferred(address previousOwner, address newOwner);

  function transferPossesion(uint orderId) internal {
    require(msg.sender==flowOfObject[orderId].Addresses[currentaddress[orderId]]);
    address currentEntity=msg.sender;
    currentaddress[orderId]++;
    address newentity=flowOfObject[orderId].Addresses[currentaddress[orderId]];
    require(newentity != address(0));
    emit PossesionTransferred(currentEntity, newentity);
  }

}
   
