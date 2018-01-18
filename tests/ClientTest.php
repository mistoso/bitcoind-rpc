<?php

/**
 * Created by PhpStorm.
 * User: Elena
 * Date: 18.01.2018
 * Time: 11:45
 */

use PHPUnit\Framework\TestCase;
use YarCode\Bitcoin\BitcoinRPC;

class ClientTest extends TestCase
{
    /** @var  PHPUnit_Framework_MockObject_MockObject $client */
    protected $client;
    /** @var  BitcoinRPC $bitcoinRPC */
    protected $bitcoinRPC;

    protected function setUp()
    {
        $this->client = $this->getMockBuilder('\JsonRPC\Client')
            ->setMethods(array('execute'))
            ->getMock();

        $this->client->method('execute')->will($this->returnValue('OK'));
        $this->bitcoinRPC = new BitcoinRPC($this->client);
    }

    public function testCreate()
    {
        $this->assertInstanceOf(BitcoinRPC::class, $this->bitcoinRPC->create('localhost', '8080', 'root', ''));
    }

    public function testGetBalance()
    {
        $this->assertTrue($this->bitcoinRPC->getBalance() === 'OK' && method_exists($this->bitcoinRPC, 'getBalance'));
    }

    public function testAddMultiSigAddress()
    {
        $this->assertTrue($this->bitcoinRPC->addMultiSigAddress(1, [1]) === 'OK' && method_exists($this->bitcoinRPC, 'addMultiSigAddress'));
    }

    public function testAddNode()
    {
        $this->assertTrue($this->bitcoinRPC->addNode(1, 'add') === 'OK' && method_exists($this->bitcoinRPC, 'addNode'));
    }

    public function testBackupWallet()
    {
        $this->assertTrue($this->bitcoinRPC->backupWallet(1) === 'OK' && method_exists($this->bitcoinRPC, 'backupWallet'));
    }

    public function testCreateMultiSig()
    {
        $this->assertTrue($this->bitcoinRPC->createMultiSig(1, [1]) === 'OK' && method_exists($this->bitcoinRPC, 'createMultiSig'));
    }

    public function testCreateRawTransaction()
    {
        $this->assertTrue($this->bitcoinRPC->createRawTransaction(1, 1) === 'OK' && method_exists($this->bitcoinRPC, 'createRawTransaction'));
    }

    public function testDecodeRawTransaction()
    {
        $this->assertTrue($this->bitcoinRPC->decodeRawTransaction('hex') === 'OK' && method_exists($this->bitcoinRPC, 'decodeRawTransaction'));
    }

    public function testDumpPrivKey()
    {
        $this->assertTrue($this->bitcoinRPC->dumpPrivKey('address') === 'OK' && method_exists($this->bitcoinRPC, 'dumpPrivKey'));
    }

    public function testDumpWallet()
    {
        $this->assertTrue($this->bitcoinRPC->dumpWallet('filename') === 'OK' && method_exists($this->bitcoinRPC, 'dumpWallet'));
    }

    public function testEncryptWallet()
    {
        $this->assertTrue($this->bitcoinRPC->encryptWallet('passPhrase') === 'OK' && method_exists($this->bitcoinRPC, 'encryptWallet'));
    }

    public function testGetAccount()
    {
        $this->assertTrue($this->bitcoinRPC->getAccount('address') === 'OK' && method_exists($this->bitcoinRPC, 'getAccount'));
    }

    public function testGetAccountAddress()
    {
        $this->assertTrue($this->bitcoinRPC->getAccountAddress('account') === 'OK' && method_exists($this->bitcoinRPC, 'getAccountAddress'));
    }

    public function testGetAddedNodeInfo()
    {
        $this->assertTrue($this->bitcoinRPC->getAddedNodeInfo('dns', [1]) === 'OK' && method_exists($this->bitcoinRPC, 'getAddedNodeInfo'));
    }

    public function testGetAddressesByAccount()
    {
        $this->assertTrue($this->bitcoinRPC->getAddressesByAccount('account') === 'OK' && method_exists($this->bitcoinRPC, 'getAddressesByAccount'));
    }

    public function testGetBestBlockHash()
    {
        $this->assertTrue($this->bitcoinRPC->getBestBlockHash() === 'OK' && method_exists($this->bitcoinRPC, 'getBestBlockHash'));
    }

    public function testGetBlock()
    {
        $this->assertTrue($this->bitcoinRPC->getBlock('hash') === 'OK' && method_exists($this->bitcoinRPC, 'getBlock'));
    }

    public function testGetBlockCount()
    {
        $this->assertTrue($this->bitcoinRPC->getBlockCount() === 'OK' && method_exists($this->bitcoinRPC, 'getBlockCount'));
    }

    public function testGetBlockHash()
    {
        $this->assertTrue($this->bitcoinRPC->getBlockHash('index') === 'OK' && method_exists($this->bitcoinRPC, 'getBlockHash'));
    }

    public function testGetBlockNumber()
    {
        $this->assertTrue($this->bitcoinRPC->getBlockNumber() === 'OK' && method_exists($this->bitcoinRPC, 'getBlockNumber'));
    }

    public function testGetBlockTemplate()
    {
        $this->assertTrue($this->bitcoinRPC->getBlockTemplate(['params']) === 'OK' && method_exists($this->bitcoinRPC, 'getBlockTemplate'));
    }

    public function testGetConnectionCount()
    {
        $this->assertTrue($this->bitcoinRPC->getConnectionCount() === 'OK' && method_exists($this->bitcoinRPC, 'getConnectionCount'));
    }

    public function testGetDifficulty()
    {
        $this->assertTrue($this->bitcoinRPC->getDifficulty() === 'OK' && method_exists($this->bitcoinRPC, 'getDifficulty'));
    }

    public function testGetGenerate()
    {
        $this->assertTrue($this->bitcoinRPC->getGenerate() === 'OK' && method_exists($this->bitcoinRPC, 'getGenerate'));
    }

    public function testGetHashesPerSec()
    {
        $this->assertTrue($this->bitcoinRPC->getHashesPerSec() === 'OK' && method_exists($this->bitcoinRPC, 'getHashesPerSec'));
    }

    public function testGetInfo()
    {
        $this->assertTrue($this->bitcoinRPC->getInfo() === 'OK' && method_exists($this->bitcoinRPC, 'getInfo'));
    }

    public function testGetMiningInfo()
    {
        $this->assertTrue($this->bitcoinRPC->getMiningInfo() === 'OK' && method_exists($this->bitcoinRPC, 'getMiningInfo'));
    }

    public function testListAccounts()
    {
        $this->assertTrue($this->bitcoinRPC->listAccounts(1) === 'OK' && method_exists($this->bitcoinRPC, 'listAccounts'));
    }

    public function testGetNewAddress()
    {
        $this->assertTrue($this->bitcoinRPC->getNewAddress('account') === 'OK' && method_exists($this->bitcoinRPC, 'getNewAddress'));
    }

    public function testGetPeerInfo()
    {
        $this->assertTrue($this->bitcoinRPC->getPeerInfo() === 'OK' && method_exists($this->bitcoinRPC, 'getPeerInfo'));
    }

    public function testGetRawChangeAddress()
    {
        $this->assertTrue($this->bitcoinRPC->getRawChangeAddress('account') === 'OK' && method_exists($this->bitcoinRPC, 'getRawChangeAddress'));
    }

    public function testGetRawMemPool()
    {
        $this->assertTrue($this->bitcoinRPC->getRawMemPool() === 'OK' && method_exists($this->bitcoinRPC, 'getRawMemPool'));
    }

    public function testGetRawTransaction()
    {
        $this->assertTrue($this->bitcoinRPC->getRawTransaction('txid', 1) === 'OK' && method_exists($this->bitcoinRPC, 'getRawTransaction'));
    }

    public function testGetReceivedByAccount()
    {
        $this->assertTrue($this->bitcoinRPC->getReceivedByAccount('account', 1) === 'OK' && method_exists($this->bitcoinRPC, 'getReceivedByAccount'));
    }

    public function testGetReceivedByAddress()
    {
        $this->assertTrue($this->bitcoinRPC->getReceivedByAddress('address', 1) === 'OK' && method_exists($this->bitcoinRPC, 'getReceivedByAddress'));
    }

    public function testGetTransaction()
    {
        $this->assertTrue($this->bitcoinRPC->getTransaction('txid') === 'OK' && method_exists($this->bitcoinRPC, 'getTransaction'));
    }

    public function testGetTxout()
    {
        $this->assertTrue($this->bitcoinRPC->getTxout('txid', 1, true) === 'OK' && method_exists($this->bitcoinRPC, 'getTxout'));
    }

    public function testGetTxoutSetInfo()
    {
        $this->assertTrue($this->bitcoinRPC->getTxoutSetInfo() === 'OK' && method_exists($this->bitcoinRPC, 'getTxoutSetInfo'));
    }

    public function testGetWork()
    {
        $this->assertTrue($this->bitcoinRPC->getWork('data') === 'OK' && method_exists($this->bitcoinRPC, 'getWork'));
    }

    public function testHelp()
    {
        $this->assertTrue($this->bitcoinRPC->help('command') === 'OK' && method_exists($this->bitcoinRPC, 'help'));
    }

    public function testImportPrivKey()
    {
        $this->assertTrue($this->bitcoinRPC->importPrivKey('privKey', 'label', true) === 'OK' && method_exists($this->bitcoinRPC, 'importPrivKey'));
    }

    public function testInvalidateBlock()
    {
        $this->assertTrue($this->bitcoinRPC->invalidateBlock('hash') === 'OK' && method_exists($this->bitcoinRPC, 'invalidateBlock'));
    }

    public function testKeypoolRefill()
    {
        $this->assertTrue($this->bitcoinRPC->keypoolRefill() === 'OK' && method_exists($this->bitcoinRPC, 'keypoolRefill'));
    }

    public function testListAddressGroupings()
    {
        $this->assertTrue($this->bitcoinRPC->listAddressGroupings() === 'OK' && method_exists($this->bitcoinRPC, 'listAddressGroupings'));
    }

    public function testListReceivedByAccount()
    {
        $this->assertTrue($this->bitcoinRPC->listReceivedByAccount(1, 1) === 'OK' && method_exists($this->bitcoinRPC, 'listReceivedByAccount'));
    }

    public function testListTransactions()
    {
        $this->assertTrue($this->bitcoinRPC->listTransactions('account', 1, 'from') === 'OK' && method_exists($this->bitcoinRPC, 'listTransactions'));
    }

    public function testListUnspent()
    {
        $this->assertTrue($this->bitcoinRPC->listUnspent(1,10) === 'OK' && method_exists($this->bitcoinRPC, 'listUnspent'));
    }

    public function testListLockUnspent()
    {
        $this->assertTrue($this->bitcoinRPC->listLockUnspent() === 'OK' && method_exists($this->bitcoinRPC, 'listLockUnspent'));
    }

    public function testLockUnspent()
    {
        $this->assertTrue($this->bitcoinRPC->lockUnspent('unlock', [1]) === 'OK' && method_exists($this->bitcoinRPC, 'lockUnspent'));
    }

    public function testMove()
    {
        $this->assertTrue($this->bitcoinRPC->move('from', 'to', 123, 1, 'comment') === 'OK' && method_exists($this->bitcoinRPC, 'move'));
    }

    public function testSendFrom()
    {
        $this->assertTrue($this->bitcoinRPC->sendFrom('from', 'to', 123, 1, 'comment', 'commentTo') === 'OK' && method_exists($this->bitcoinRPC, 'sendFrom'));
    }

    public function testSendMany()
    {
        $this->assertTrue($this->bitcoinRPC->sendMany('from', 'to', 123, 'comment') === 'OK' && method_exists($this->bitcoinRPC, 'sendMany'));
    }

    public function testSendRawTransaction()
    {
        $this->assertTrue($this->bitcoinRPC->sendRawTransaction('string') === 'OK' && method_exists($this->bitcoinRPC, 'sendRawTransaction'));
    }

    public function testSetAccount()
    {
        $this->assertTrue($this->bitcoinRPC->setAccount('address', 'account') === 'OK' && method_exists($this->bitcoinRPC, 'setAccount'));
    }

    public function testSetGenerate()
    {
        $this->assertTrue($this->bitcoinRPC->setGenerate('generate', 5) === 'OK' && method_exists($this->bitcoinRPC, 'setGenerate'));
    }

     public function testSetTxFee()
    {
        $this->assertTrue($this->bitcoinRPC->setTxFee(123) === 'OK' && method_exists($this->bitcoinRPC, 'setTxFee'));
    }

    public function testSignMessage()
    {
        $this->assertTrue($this->bitcoinRPC->signMessage('address', 'message') === 'OK' && method_exists($this->bitcoinRPC, 'signMessage'));
    }

    public function testSignRawTransaction()
    {
        $this->assertTrue($this->bitcoinRPC->signRawTransaction('hex', 'message','keys') === 'OK' && method_exists($this->bitcoinRPC, 'signRawTransaction'));
    }

    public function testStop()
    {
        $this->assertTrue($this->bitcoinRPC->stop() === 'OK' && method_exists($this->bitcoinRPC, 'stop'));
    }

    public function testSubmitBlock()
    {
        $this->assertTrue($this->bitcoinRPC->submitBlock('hex','params') === 'OK' && method_exists($this->bitcoinRPC, 'submitBlock'));
    }

    public function testListReceivedByAddress()
    {
        $this->assertTrue($this->bitcoinRPC->listReceivedByAddress(1,5) === 'OK' && method_exists($this->bitcoinRPC, 'listReceivedByAddress'));
    }

    public function testListSinceBlock()
    {
        $this->assertTrue($this->bitcoinRPC->listSinceBlock('hash','target') === 'OK' && method_exists($this->bitcoinRPC, 'listSinceBlock'));
    }

    public function testSendToAddress()
    {
        $this->assertTrue($this->bitcoinRPC->sendToAddress('address',123, 'comment', 'commentTo') === 'OK' && method_exists($this->bitcoinRPC, 'sendToAddress'));
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