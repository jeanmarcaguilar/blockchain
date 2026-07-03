// SPDX-License-Identifier: MIT
pragma solidity ^0.8.20;

/**
 * @title BlockCartTransaction
 * @dev Stores e-commerce order verification data on Ethereum blockchain
 */
contract BlockCartTransaction {
    struct Transaction {
        string orderId;
        string customerHash;
        uint256 totalAmount;
        string orderStatus;
        uint256 timestamp;
        bool exists;
    }

    address public owner;
    mapping(string => Transaction) private transactions;
    string[] public orderIds;

    event TransactionCreated(string indexed orderId, string customerHash, uint256 totalAmount, uint256 timestamp);
    event StatusUpdated(string indexed orderId, string newStatus, uint256 timestamp);

    modifier onlyOwner() {
        require(msg.sender == owner, "Only owner");
        _;
    }

    constructor() {
        owner = msg.sender;
    }

    function createTransaction(
        string memory _orderId,
        string memory _customerHash,
        uint256 _totalAmount
    ) public returns (uint256) {
        require(!transactions[_orderId].exists, "Transaction exists");
        transactions[_orderId] = Transaction({
            orderId: _orderId,
            customerHash: _customerHash,
            totalAmount: _totalAmount,
            orderStatus: "pending",
            timestamp: block.timestamp,
            exists: true
        });
        orderIds.push(_orderId);
        emit TransactionCreated(_orderId, _customerHash, _totalAmount, block.timestamp);
        return block.number;
    }

    function verifyTransaction(string memory _orderId) public view returns (bool) {
        return transactions[_orderId].exists;
    }

    function getTransaction(string memory _orderId) public view returns (Transaction memory) {
        require(transactions[_orderId].exists, "Not found");
        return transactions[_orderId];
    }

    function getBlockNumber() public view returns (uint256) {
        return block.number;
    }

    function transactionExists(string memory _orderId) public view returns (bool) {
        return transactions[_orderId].exists;
    }

    function updateOrderStatus(string memory _orderId, string memory _newStatus) public onlyOwner {
        require(transactions[_orderId].exists, "Not found");
        transactions[_orderId].orderStatus = _newStatus;
        emit StatusUpdated(_orderId, _newStatus, block.timestamp);
    }
}
