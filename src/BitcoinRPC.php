<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace YarCode\Bitcoin;

use JsonRPC\Client;

class BitcoinRPC
{
    /** @var Client */
    protected $client;

    /**
     * @param string $host
     * @param string $port
     * @param string $user
     * @param string $password
     * @return static
     */
    public static function create($host, $port, $user, $password)
    {
        $client = new Client("http://{$host}:{$port}/");
        $client->authentication($user, $password);

        return new static($client);
    }

    public function __construct(Client $client)
    {
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

    /**
     * Creates a raw transaction spending given inputs
     *
     * @param $params
     * @param $addresses
     * @return mixed
     */
    public function createRawTransaction($params, $addresses)
    {
        return $this->call('createrawtransaction', [$params, $addresses]);
    }

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
     *    Encrypts the wallet with <passphrase>
     *
     * @param string $passPhrase
     * @return mixed
     */
    public function encryptWallet($passPhrase)
    {
        return $this->call('encryptwallet', [$passPhrase]);
    }

    /**
     * Returns the account associated with the given address.
     *
     * @param string $address
     * @return array
     */
    public function getAccount($address = null)
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
    public function getAccountAddress($account = null)
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
    public function getAddressesByAccount($account = null)
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
        return $this->call('getblockhash', [$index]);
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
     * Returns data needed to construct a block to work on. See BIP_0022 for more info on params
     *
     * @param array $params
     * @return mixed
     */
    public function getBlockTemplate($params)
    {
        return $this->call('getblocktemplate', [$params]);
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

    /**
     * Returns the proof-of-work difficulty as a multiple of the minimum difficulty
     *
     * @return mixed
     */
    public function getDifficulty()
    {
        return $this->call('getdifficulty');
    }

    /**
     * Returns true or false whether bitcoind is currently generating hashes
     *
     * @return mixed
     */
    public function getGenerate()
    {
        return $this->call('getgenerate');
    }

    /**
     * Returns a recent hashes per second performance measurement while generating
     *
     * @return mixed
     */
    public function getHashesPerSec()
    {
        return $this->call('gethashespersec');
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
     * Returns an object containing mining-related information:
     * blocks
     * currentblocksize
     * currentblocktx
     * difficulty
     * errors
     * generate
     * genproclimit
     * hashespersec
     * pooledtx
     * testnet
     *
     * @return mixed
     */
    public function getMiningInfo()
    {
        return $this->call('getmininginfo');
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
     * Returns data about each connected node
     *
     * @return mixed
     */
    public function getPeerInfo()
    {
        return $this->call('getpeerinfo');
    }

    /**
     * Returns a new Bitcoin address, for receiving change. This is for use with raw transactions, NOT normal use
     *
     * @param null|string $account
     * @return mixed
     */
    public function getRawChangeAddress($account = null)
    {
        return $this->call('getrawchangeaddress', [$account]);
    }

    /**
     * Returns all transaction ids in memory pool
     *
     * @return mixed
     */
    public function getRawMemPool()
    {
        return $this->call('getrawmempool');
    }

    /**
     * Returns raw transaction representation for given transaction id
     *
     * @param string $txid
     * @param null $verbose
     * @return mixed
     */
    public function getRawTransaction($txid, $verbose = null)
    {
        return $this->call('getrawtransaction', [$txid, $verbose]);
    }

    /**
     * Returns the total amount received by addresses with [account] in transactions with at least [minconf] confirmations.
     * If [account] not provided return will include all transactions to all accounts
     *
     * @param null|string $account
     * @param int $minConf
     * @return mixed
     */
    public function getReceivedByAccount($account = null, $minConf = 1)
    {
        return $this->call('getreceivedbyaccount', [$account, $minConf]);
    }

    /**
     * Returns the amount received by <bitcoinaddress> in transactions with at least [minconf] confirmations.
     * It correctly handles the case where someone has sent to the address in multiple transactions.
     * Keep in mind that addresses are only ever used for receiving transactions.
     * Works only for addresses in the local wallet, external addresses will always show 0
     *
     * @param string $address
     * @param int $minConf
     * @return mixed
     */
    public function getReceivedByAddress($address, $minConf = 1)
    {
        return $this->call('getreceivedbyaddress', [$address, $minConf]);
    }

    /**
     * Returns an object about the given transaction containing:
     * "amount" : total amount of the transaction
     * "confirmations" : number of confirmations of the transaction
     * "txid" : the transaction ID
     * "time" : time associated with the transaction[1].
     * "details" - An array of objects containing:
     *  "account"
     *  "address"
     *  "category"
     *  "amount"
     *  "fee"
     *
     * @param string $txid
     * @return mixed
     */
    public function getTransaction($txid)
    {
        return $this->call('gettransaction', [$txid]);
    }

    /**
     *    Returns details about an unspent transaction output (UTXO)
     *
     * @param $txid
     * @param $n
     * @param bool $includeMemPool
     * @return mixed
     */
    public function getTxout($txid, $n, $includeMemPool = true)
    {
        return $this->call('gettxout', [$txid, $n, $includeMemPool]);
    }

    /**
     * Returns statistics about the unspent transaction output (UTXO) set
     *
     * @return mixed
     */
    public function getTxoutSetInfo()
    {
        return $this->call('gettxoutsetinfo');
    }

    /**
     * If [data] is not specified, returns formatted hash data to work on:
     * "midstate" : precomputed hash state after hashing the first half of the data
     * "data" : block data
     * "hash1" : formatted hash buffer for second hash
     * "target" : little endian hash target
     * If [data] is specified, tries to solve the block and returns true if it was successful.
     *
     * @param $data
     * @return mixed
     */
    public function getWork($data)
    {
        return $this->call('getwork', [$data]);
    }

    /**
     * List commands, or get help for a command
     *
     * @param $command
     * @return mixed
     */
    public function help($command)
    {
        return $this->call('help', [$command]);
    }

    /**
     * Adds a private key (as returned by dumpprivkey) to your wallet.
     * This may take a while, as a rescan is done, looking for existing transactions. Optional [rescan] parameter added in 0.8.0.
     * Note: There's no need to import public key, as in ECDSA (unlike RSA) this can be computed from private key.
     *
     * @param $bitcoinPrivKey
     * @param $label
     * @param bool $rescan
     * @return mixed
     */
    public function importPrivKey($bitcoinPrivKey, $label, $rescan = true)
    {
        return $this->call('importprivkey', [$bitcoinPrivKey, $label, $rescan]);
    }

    /**
     * Permanently marks a block as invalid, as if it violated a consensus rule
     *
     * @param $hash
     * @return mixed
     */
    public function invalidateBlock($hash)
    {
        return $this->call('invalidateblock', [$hash]);
    }

    /**
     * Fills the keypool, requires wallet passphrase to be set
     *
     * @return mixed
     */
    public function keypoolRefill()
    {
        return $this->call('keypoolrefill');
    }

    /**
     * Returns all addresses in the wallet and info used for coincontrol
     *
     * @return mixed
     */
    public function listAddressGroupings()
    {
        return $this->call('listaddressgroupings');
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
     * Returns array of unspent transaction inputs in the wallet
     *
     * @param int $minConf
     * @param int $maxConf
     * @return mixed
     */
    public function listUnspent($minConf = 1, $maxConf = 999999)
    {
        return $this->call('listunspent', [$minConf, $maxConf]);
    }

    /**
     * Returns list of temporarily unspendable outputs
     *
     * @return mixed
     */
    public function listLockUnspent()
    {
        return $this->call('listlockunspent');
    }

    /**
     * Updates list of temporarily unspendable outputs
     *
     * @param $unlock
     * @param $arrayOfObjects
     * @return mixed
     */
    public function lockUnspent($unlock, $arrayOfObjects)
    {
        return $this->call('lockunspent', [$unlock, $arrayOfObjects]);
    }

    /**
     * Move from one account in your wallet to another
     *
     * @param string $fromAccount
     * @param string $toAccount
     * @param $amount
     * @param int $minConf
     * @param string $comment
     * @return mixed
     */
    public function move($fromAccount, $toAccount, $amount, $minConf = 1, $comment)
    {
        return $this->call('move', [$fromAccount, $toAccount, $amount, $minConf, $comment]);
    }

    /**
     * <amount> is a real and is rounded to 8 decimal places.
     * Will send the given amount to the given address, ensuring the account has a valid balance using [minconf] confirmations.
     * Returns the transaction ID if successful (not in JSON object)
     *
     * @param $fromAccount
     * @param $toBitcoinAddress
     * @param $amount
     * @param int $minConf
     * @param $comment
     * @param $commentTo
     * @return mixed
     */
    public function sendFrom($fromAccount, $toBitcoinAddress, $amount, $minConf = 1, $comment, $commentTo)
    {
        return $this->call('sendfrom', [$fromAccount, $toBitcoinAddress, $amount, $minConf, $comment, $commentTo]);
    }

    /**
     * amounts are double-precision floating point numbers
     *
     * @param $fromAccount
     * @param $addresses
     * @param int $minConf
     * @param $comment
     * @return mixed
     */
    public function sendMany($fromAccount, $addresses, $minConf = 1, $comment)
    {
        return $this->call('sendmany', [$fromAccount, $addresses, $minConf, $comment]);
    }

    /**
     * Submits raw transaction (serialized, hex-encoded) to local node and network
     *
     * @param $hexstring
     * @return mixed
     */
    public function sendRawTransaction($hexstring)
    {
        return $this->call('sendrawtransaction', [$hexstring]);
    }

    /**
     * Sets the account associated with the given address.
     * Assigning address that is already assigned to the same account will create a new address associated with that account
     *
     * @param $address
     * @param null $account
     * @return mixed
     */
    public function setAccount($address, $account = null)
    {
        return $this->call('setaccount', [$address, $account]);
    }

    /**
     *    <generate> is true or false to turn generation on or off.
     * Generation is limited to [genproclimit] processors, -1 is unlimited
     *
     * @param $generate
     * @param $genprocLimit
     * @return mixed
     */
    public function setGenerate($generate, $genprocLimit)
    {
        return $this->call('setgenerate', [$generate, $genprocLimit]);
    }

    /**
     * <amount> is a real and is rounded to the nearest 0.00000001
     *
     * @param $amount
     * @return mixed
     */
    public function setTxFee($amount)
    {
        return $this->call('settxfee', [$amount]);
    }

    /**
     * Sign a message with the private key of an address
     *
     * @param $address
     * @param $message
     * @return mixed
     */
    public function signMessage($address, $message)
    {
        return $this->call('signmessage', [$address, $message]);
    }

    /**
     * Adds signatures to a raw transaction and returns the resulting raw transaction
     *
     * @param $hexstring
     * @param $params
     * @param $privateKeys
     * @return mixed
     */
    public function signRawTransaction($hexstring, $params, $privateKeys)
    {
        return $this->call('signrawtransaction', [$hexstring, $params, $privateKeys]);
    }

    /**
     * Stop bitcoin server
     *
     * @return mixed
     */
    public function stop()
    {
        return $this->call('stop');
    }

    /**
     * Attempts to submit new block to network
     *
     * @param $hexData
     * @param $optionalParamsObj
     * @return mixed
     */
    public function submitBlock($hexData, $optionalParamsObj)
    {
        return $this->call('submitblock', [$hexData, $optionalParamsObj]);
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
     * Get all transactions in blocks since block [blockhash], or all transactions if omitted.
     * [target-confirmations] intentionally does not affect the list of returned transactions, but only affects the returned "lastblock" value
     *
     * @param $blockHash
     * @param $targetConfirmations
     * @return mixed
     */
    public function listSinceBlock($blockHash, $targetConfirmations)
    {
        return $this->call('listsinceblock', [$blockHash, $targetConfirmations]);
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