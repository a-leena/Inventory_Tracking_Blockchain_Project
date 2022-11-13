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
const managerAddress = "0xfC7723bF47bC3276089fb60b7B16d0E181d0D4Fe"
//Manufacturer.sol: 
const manufacturerAddress = "0x7CB3009163cc1E3A89D93940370DA6561685071b"
//LandTransport.sol: 
const LTAddress = "0xcCDe99Ffc72DB8A6eaad84C3B8568D106203E780"
//Customs.sol: 
const customsAddress = "0xc2384e44CF523Eaf42F44cf8217547A6BB06f0f2"
//PortAuthority.sol: 
const portAuthAddress = "0x3948Fe20abBAD3de550cBF73af08bc0A5cBE012a"
//Shipment.sol: 
const shipmentAddress = "0x6768Db03D008dF0B01bAcC677a12E15ec735F103"
//Distributor.sol: 
const distributorAddress = "0x276a2365C9A98dA0a4aee6B1D569ae64BE089aB8"

// //Instantiat the smart contracts in order to call the functions in JS-
// const web3 = new Web3(new Web3.providers.HttpProvider('HTTP://127.0.0.1:7545'));
// const contracts = new web3.eth.Contract(inventory_tracking_ABI, web3);


// //reading value from a smart contract
// var pid, userID, prodname, desc, quantity, totalcost;
// var order_id;
// contracts.methods.setOrder(pid,userID,prodname,desc,quantity,totalcost).call(function (err, res) {
// 	if (err) {
// 	  console.log("An error occured", err);
// 	  return;
// 	}
// 	order_id = res;
// 	console.log("The OrderID is: ", res);
//   })

// //passing values into a smartcontract
// contracts.methods.currentStatusOfOrder(order_id)
//   .send({ from: senderAddress }, function (err, res) {
//     if (err) {
//       console.log("An error occured", err);
//       return;
//     }
//     console.log(res);
//   })