<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace YarCode\Bitcoin;

use JsonRPC\Client;

class BitcoinRPC
{
    public $host;
    public $port;
    public $user;
    public $password;

    /** @var Client */
    protected $client;

    public function __construct($host, $port, $user, $password)
    {
        $this->host = $host;
        $this->port = $port;
        $this->user = $user;
        $this->password = $password;

        assert(isset($this->host, $this->port, $this->user, $this->password));

        $client = new Client("http://{$this->host}:{$this->port}/");
        $client->authentication($this->user, $this->password);

        $this->client = $client;
    }

    public function __call($name, $arguments)
    {
        if (count($arguments)) {
            $arguments = array_shift($arguments);
        }
        return $this->client->execute($name, $arguments);
    }

    protected function call($methodName, $params = [])
    {
        $actualParams = [];
        foreach ($params as $param) {
            if ($param === null) {
                break;
            }
            $actualParams[] = $param;
        }
        return $this->client->execute($methodName, $actualParams);
    }

    /**
     * Add a nrequired-to-sign multisignature address to the wallet. Each key is a bitcoin address or hex-encoded public key. If [account] is specified, assign address to [account].
     * Returns a string containing the address.
     *
     * @param string $nRequired
     * @param array $keys
     * @param string $account
     * @return mixed
     */
    public function addMultiSigAddress($nRequired, $keys, $account = null)
    {
        return $this->call('addmultisigaddress', [$nRequired, $keys, $account]);
    }

    /**
     * Attempts add or remove <node> from the addnode list or try a connection to <node> once.
     *
     * @param string $node
     * @param string $mode One of: add/remove/onetry
     * @return mixed
     * @since 0.8
     */
    public function addNode($node, $mode)
    {
        return $this->call('addnode', [$node, $mode]);
    }

    /**
     * Safely copies wallet.dat to destination, which can be a directory or a path with filename.
     *
     * @param string $path
     * @return mixed
     */
    public function backupWallet($path)
    {
        return $this->call('backupwallet', [$path]);
    }

    /**
     * Creates a multi-signature address and returns a json object
     *
     * @param string $nRequired
     * @param array $keys
     * @return mixed
     */
    public function createMultiSig($nRequired, $keys)
    {
        return $this->call('createmultisig', [$nRequired, $keys]);
    }

    //public function createRawTransaction()

    /**
     * Produces a human-readable JSON object for a raw transaction
     *
     * @param string $hexString
     * @return mixed
     */
    public function decodeRawTransaction($hexString)
    {
        return $this->call('decoderawtransaction', [$hexString]);
    }

    /**
     * Reveals the private key corresponding to <bitcoinaddress>
     *
     * @param string $address
     * @return mixed
     */
    public function dumpPrivKey($address)
    {
        return $this->call('dumpprivkey', [$address]);
    }

    /**
     * Exports all wallet private keys to file
     *
     * @param string $filename
     * @return mixed
     */
    public function dumpWallet($filename)
    {
        return $this->call('dumpwallet', [$filename]);
    }

    /**
     * 	Encrypts the wallet with <passphrase>
     *
     * @param string $passphrase
     * @return mixed
     */
    public function encryptWallet($passphrase)
    {
        return $this->call('encryptwallet', [$passphrase]);
    }

    /**
     * Returns the account associated with the given address.
     *
     * @param string $address
     * @return array
     */
    public function getAccount($address)
    {
        return $this->call('getaccount', [$address]);
    }

    /**
     * Returns the current bitcoin address for receiving payments to this account.
     * If <account> does not exist, it will be created along with an associated new address that will be returned.
     *
     * @param string $account
     * @return string
     */
    public function getAccountAddress($account)
    {
        return $this->call('getaccountaddress', [$account]);
    }

    /**
     * Returns information about the given added node, or all added nodes
     * (note that onetry addnodes are not listed here) If dns is false, only a list of added nodes will be provided, otherwise connected information will also be available
     *
     * @param string $dns
     * @param array $node
     * @return mixed
     */
    public function getAddedNodeInfo($dns, $node)
    {
        return $this->call('getaddednodeinfo', [$dns, $node]);
    }

    /**
     * Returns the list of addresses for the given account.
     *
     * @param string $account
     * @return array
     */
    public function getAddressesByAccount($account)
    {
        return $this->call('getaddressesbyaccount', [$account]);
    }

    /**
     * If [account] is not specified, returns the server's total available balance.
     *  If [account] is specified, returns the balance in the account.
     *
     * @param null|string $account
     * @param null|integer $minConf default 1
     * @return float
     */
    public function getBalance($account = null, $minConf = null)
    {
        return $this->call('getbalance', [$account, $minConf]);
    }

    /**
     * Returns the hash of the best (tip) block in the longest block chain.
     *
     * @return string
     * @since 0.9
     */
    public function getBestBlockHash()
    {
        return $this->call('getbestblockhash');
    }

    /**
     * Returns information about the block with the given hash.
     *
     * @param string $hash
     * @return array
     */
    public function getBlock($hash)
    {
        return $this->call('getblock', [$hash]);
    }

    /**
     * Returns the number of blocks in the longest block chain.
     *
     * @return integer
     */
    public function getBlockCount()
    {
        return $this->call('getblockcount');
    }

    /**
     * Returns hash of block in best-block-chain at <index>; index 0 is the genesis block.
     *
     * @param integer $index
     * @return string
     */
    public function getBlockHash($index)
    {
        return $this->call('getblockhash',[$index]);
    }

    /**
     * Use getblockcount
     *
     * @return mixed
     */
    public function getBlockNumber()
    {
        return $this->call('getblockcount');
    }

    /**
     * Returns the number of connections to other nodes.
     *
     * @return integer
     */
    public function getConnectionCount()
    {
        return $this->call('getconnectioncount');
    }

    public function getDifficulty()
    {

    }

    /**
     * Returns an object containing various state info.
     *
     * @return array
     */
    public function getInfo()
    {
        return $this->call('getinfo');
    }

    /**
     * Object that has account names as keys, account balances as values.
     *
     * @param null|int $minConf default 1
     * @return array
     */
    public function listAccounts($minConf = null)
    {
        return $this->call('listaccounts', [$minConf]);
    }

    /**
     * Returns a new bitcoin address for receiving payments.
     * If [account] is specified payments received with the address will be credited to [account].
     *
     * @param null|string $account
     * @return string
     */
    public function getNewAddress($account = null)
    {
        return $this->call('getnewaddress', [$account]);
    }

    /**
     * Returns an array of objects containing:
     * "account" : the account of the receiving addresses
     * "amount" : total amount received by addresses with this account
     * "confirmations" : number of confirmations of the most recent transaction included
     *
     * @param null|int $minConf default 1
     * @param null|bool $includeEmpty default false
     * @return array
     */
    public function listReceivedByAccount($minConf = null, $includeEmpty = null)
    {
        return $this->call('listreceivedbyaccount', [$minConf, $includeEmpty]);
    }

    /**
     * Returns up to [count] most recent transactions skipping the first [from] transactions for account [account].
     * If [account] not provided it'll return recent transactions from all accounts.
     *
     * @param null|string $account
     * @param null|int $count default 10
     * @param null|int $from default 0
     * @return mixed
     */
    public function listTransactions($account = null, $count = null, $from = null)
    {
        return $this->call('listtransactions', [$account, $count, $from]);
    }

    /**
     * Returns an array of objects containing:
     * "address" : receiving address
     * "account" : the account of the receiving address
     * "amount" : total amount received by the address
     * "confirmations" : number of confirmations of the most recent transaction included
     * To get a list of accounts on the system, execute bitcoind listreceivedbyaddress 0 true
     *
     * @param null|int $minConf default 1
     * @param null|bool $includeEmpty default false
     * @return array
     */
    public function listReceivedByAddress($minConf = null, $includeEmpty = null)
    {
        return $this->call('listreceivedbyaddress', [$minConf, $includeEmpty]);
    }

    /**
     * <amount> is a real and is rounded to 8 decimal places. Returns the transaction ID <txid> if successful.
     *
     * @param string $address
     * @param float $amount
     * @param null|string $comment
     * @param null|string $commentTo
     * @return mixed
     */
    public function sendToAddress($address, $amount, $comment = null, $commentTo = null)
    {
        $amount = round($amount, 8);
        return $this->call('sendtoaddress', [$address, $amount, $comment, $commentTo]);
    }

    /**
     * Return information about <bitcoinaddress>.
     *
     * @param string $address
     * @return mixed
     */
    public function validateAddress($address)
    {
        return $this->call('validateaddress', [$address]);
    }

    /**
     * Verify a signed message.
     *
     * @param string $address
     * @param string $signature
     * @param string $message
     * @return mixed
     */
    public function verifyMessage($address, $signature, $message)
    {
        return $this->call('verifymessage', [$address, $signature, $message]);
    }

    /**
     * Removes the wallet encryption key from memory, locking the wallet.
     * After calling this method, you will need to call walletpassphrase again before being able to call any methods
     * which require the wallet to be unlocked.
     *
     * @return mixed
     */
    public function walletLock()
    {
        return $this->call('walletlock');
    }

    /**
     * Stores the wallet decryption key in memory for <timeout> seconds.
     *
     * @param string $passPhrase
     * @param int $timeout
     * @return mixed
     */
    public function walletPassPhrase($passPhrase, $timeout)
    {
        return $this->call('walletpassphrase', [$passPhrase, $timeout]);
    }

    /**
     * Changes the wallet passphrase from <oldpassphrase> to <newpassphrase>.
     *
     * @param string $oldPassPhrase
     * @param string $newPassPhrase
     * @return mixed
     */
    public function walletPassPhraseChange($oldPassPhrase, $newPassPhrase)
    {
        return $this->call('walletpassphrasechange', [$oldPassPhrase, $newPassPhrase]);
    }
}