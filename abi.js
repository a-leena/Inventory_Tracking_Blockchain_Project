//abi 
const inventory_tracking_ABI = [
	{
		"constant": false,
		"inputs": [
			{
				"name": "orderId",
				"type": "uint256"
			},
			{
				"name": "Idealweight",
				"type": "uint256"
			}
		],
		"name": "ApproveInCategory",
		"outputs": [],
		"payable": false,
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"constant": false,
		"inputs": [
			{
				"name": "orderId",
				"type": "uint256"
			},
			{
				"name": "Weight",
				"type": "uint256"
			}
		],
		"name": "CheckWeight",
		"outputs": [],
		"payable": false,
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"constant": false,
		"inputs": [
			{
				"name": "orderId",
				"type": "uint256"
			},
			{
				"name": "Weight",
				"type": "uint256"
			},
			{
				"name": "Idealweight",
				"type": "uint256"
			}
		],
		"name": "customsChecked",
		"outputs": [],
		"payable": false,
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"constant": false,
		"inputs": [
			{
				"name": "orderId",
				"type": "uint256"
			},
			{
				"name": "_manufacturer",
				"type": "address"
			},
			{
				"name": "_exlandtrasport",
				"type": "address"
			},
			{
				"name": "_excustoms",
				"type": "address"
			},
			{
				"name": "_exportAuthority",
				"type": "address"
			},
			{
				"name": "_shipping",
				"type": "address"
			},
			{
				"name": "_importAuthority",
				"type": "address"
			},
			{
				"name": "_imcustoms",
				"type": "address"
			},
			{
				"name": "_imlandtransport",
				"type": "address"
			},
			{
				"name": "_distributor",
				"type": "address"
			}
		],
		"name": "setflowoforder",
		"outputs": [],
		"payable": false,
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"constant": false,
		"inputs": [
			{
				"name": "p_Id",
				"type": "uint256"
			},
			{
				"name": "user_id",
				"type": "uint256"
			},
			{
				"name": "name",
				"type": "string"
			},
			{
				"name": "Description",
				"type": "string"
			},
			{
				"name": "Quantity",
				"type": "uint256"
			},
			{
				"name": "_totalCost",
				"type": "uint256"
			}
		],
		"name": "setOrder",
		"outputs": [
			{
				"name": "",
				"type": "uint256"
			}
		],
		"payable": false,
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"anonymous": false,
		"inputs": [
			{
				"indexed": false,
				"name": "orderId",
				"type": "uint256"
			}
		],
		"name": "passed",
		"type": "event"
	},
	{
		"anonymous": false,
		"inputs": [
			{
				"indexed": false,
				"name": "orderId",
				"type": "uint256"
			}
		],
		"name": "unpassed",
		"type": "event"
	},
	{
		"anonymous": false,
		"inputs": [
			{
				"indexed": false,
				"name": "orderId",
				"type": "uint256"
			}
		],
		"name": "underweight",
		"type": "event"
	},
	{
		"anonymous": false,
		"inputs": [
			{
				"indexed": false,
				"name": "orderId",
				"type": "uint256"
			}
		],
		"name": "overweight",
		"type": "event"
	},
	{
		"anonymous": false,
		"inputs": [
			{
				"indexed": false,
				"name": "previousOwner",
				"type": "address"
			},
			{
				"indexed": false,
				"name": "newOwner",
				"type": "address"
			}
		],
		"name": "PossesionTransferred",
		"type": "event"
	},
	{
		"constant": true,
		"inputs": [
			{
				"name": "",
				"type": "uint256"
			}
		],
		"name": "bankConfirmation",
		"outputs": [
			{
				"name": "",
				"type": "bool"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [
			{
				"name": "",
				"type": "uint256"
			}
		],
		"name": "itemMap",
		"outputs": [
			{
				"name": "product_Id",
				"type": "uint256"
			},
			{
				"name": "name",
				"type": "string"
			},
			{
				"name": "description",
				"type": "string"
			},
			{
				"name": "quantity",
				"type": "uint256"
			},
			{
				"name": "totalCost",
				"type": "uint256"
			},
			{
				"name": "weight",
				"type": "uint256"
			},
			{
				"name": "shipmentId",
				"type": "uint256"
			},
			{
				"name": "totalTimeRequired",
				"type": "uint256"
			},
			{
				"name": "shipagent",
				"type": "uint256"
			},
			{
				"name": "manufacturer",
				"type": "address"
			},
			{
				"name": "distributor",
				"type": "address"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [
			{
				"name": "",
				"type": "uint256"
			}
		],
		"name": "statsMap",
		"outputs": [
			{
				"name": "checkPoint",
				"type": "string"
			},
			{
				"name": "timeTheEventCalled",
				"type": "uint256"
			},
			{
				"name": "timeToNextEntity",
				"type": "uint256"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	}
]


//Contract addresses:

//Manager.sol: 
const managerAddress = "0x7B7BcF566f82c78a06f48B4F4Dda8940aB7163ED"
//Manufacturer.sol: 
const manufacturerAddress = "0x7318c03133491D9dE905FA7eD23c05E7a6588015"
//LandTransport.sol: 
const LTAddress = "0x4162206011D949b8bE06a25b539FE65474D0624D"
//Customs.sol: 
const customsAddress = "0x5cCF1FA42674CeE5B175B0Fe18d3bc09003B9436"
//PortAuthority.sol: 
const portAuthAddress = "0x315334199A058803a5322a51139CbD410e445747"
//Shipment.sol: 
const shipmentAddress = "0xC9Df14c45ff28f6E31AE66bCC115E7486051839b"
//Distributor.sol: 
const distributorAddress = "0xCfb531B2691F8b1d50A77097D3ee625dAaA3F7E2"

//Instantiat the smart contracts in order to call the functions in JS-
const web3 = new Web3(new Web3.providers.HttpProvider('HTTP://127.0.0.1:7545'));
const contracts = new web3.eth.Contract(inventory_tracking_ABI, web3);


//reading value from a smart contract
var pid, userID, prodname, desc, quantity, totalcost;
var order_id;
contracts.methods.setOrder(pid,userID,prodname,desc,quantity,totalcost).call(function (err, res) {
	if (err) {
	  console.log("An error occured", err);
	  return;
	}
	order_id = res;
	console.log("The OrderID is: ", res);
  })

//passing values into a smartcontract
contracts.methods.currentStatusOfOrder(order_id)
  .send({ from: senderAddress }, function (err, res) {
    if (err) {
      console.log("An error occured", err);
      return;
    }
    console.log(res);
  })