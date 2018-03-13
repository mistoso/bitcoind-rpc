<?php

/**
 * Created by PhpStorm.
 * User: Elena
 * Date: 18.01.2018
 * Time: 11:45
 */

use PHPUnit\Framework\TestCase;
use MistoSo\Bitcoin\BitcoinRPC;

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

        $this->client->method('execute')->will($this->returnValue(true));
        $this->bitcoinRPC = new BitcoinRPC($this->client);
    }

    public function testCreate()
    {
        $this->assertInstanceOf(BitcoinRPC::class, $this->bitcoinRPC->create('localhost', '8080', 'root', ''));
    }

    public function testGetBalance()
    {
        $this->assertTrue($this->bitcoinRPC->getBalance());
    }

    public function testAddMultiSigAddress()
    {
        $this->assertTrue($this->bitcoinRPC->addMultiSigAddress(1, [1]));
    }

    public function testAddNode()
    {
        $this->assertTrue($this->bitcoinRPC->addNode(1, 'add'));
    }

    public function testBackupWallet()
    {
        $this->assertTrue($this->bitcoinRPC->backupWallet(1));
    }

    public function testCreateMultiSig()
    {
        $this->assertTrue($this->bitcoinRPC->createMultiSig(1, [1]));
    }

    public function testCreateRawTransaction()
    {
        $this->assertTrue($this->bitcoinRPC->createRawTransaction(1, 1));
    }

    public function testDecodeRawTransaction()
    {
        $this->assertTrue($this->bitcoinRPC->decodeRawTransaction('hex'));
    }

    public function testDumpPrivKey()
    {
        $this->assertTrue($this->bitcoinRPC->dumpPrivKey('address'));
    }

    public function testDumpWallet()
    {
        $this->assertTrue($this->bitcoinRPC->dumpWallet('filename'));
    }

    public function testEncryptWallet()
    {
        $this->assertTrue($this->bitcoinRPC->encryptWallet('passPhrase'));
    }

    public function testGetAccount()
    {
        $this->assertTrue($this->bitcoinRPC->getAccount('address'));
    }

    public function testGetAccountAddress()
    {
        $this->assertTrue($this->bitcoinRPC->getAccountAddress('account'));
    }

    public function testGetAddedNodeInfo()
    {
        $this->assertTrue($this->bitcoinRPC->getAddedNodeInfo('dns', [1]));
    }

    public function testGetAddressesByAccount()
    {
        $this->assertTrue($this->bitcoinRPC->getAddressesByAccount('account'));
    }

    public function testGetBestBlockHash()
    {
        $this->assertTrue($this->bitcoinRPC->getBestBlockHash());
    }

    public function testGetBlock()
    {
        $this->assertTrue($this->bitcoinRPC->getBlock('hash'));
    }

    public function testGetBlockCount()
    {
        $this->assertTrue($this->bitcoinRPC->getBlockCount());
    }

    public function testGetBlockHash()
    {
        $this->assertTrue($this->bitcoinRPC->getBlockHash('index'));
    }

    public function testGetBlockNumber()
    {
        $this->assertTrue($this->bitcoinRPC->getBlockNumber());
    }

    public function testGetBlockTemplate()
    {
        $this->assertTrue($this->bitcoinRPC->getBlockTemplate(['params']));
    }

    public function testGetConnectionCount()
    {
        $this->assertTrue($this->bitcoinRPC->getConnectionCount());
    }

    public function testGetDifficulty()
    {
        $this->assertTrue($this->bitcoinRPC->getDifficulty());
    }

    public function testGetGenerate()
    {
        $this->assertTrue($this->bitcoinRPC->getGenerate());
    }

    public function testGetHashesPerSec()
    {
        $this->assertTrue($this->bitcoinRPC->getHashesPerSec());
    }

    public function testGetInfo()
    {
        $this->assertTrue($this->bitcoinRPC->getInfo());
    }

    public function testGetMiningInfo()
    {
        $this->assertTrue($this->bitcoinRPC->getMiningInfo());
    }

    public function testListAccounts()
    {
        $this->assertTrue($this->bitcoinRPC->listAccounts(1));
    }

    public function testGetNewAddress()
    {
        $this->assertTrue($this->bitcoinRPC->getNewAddress('account'));
    }

    public function testGetPeerInfo()
    {
        $this->assertTrue($this->bitcoinRPC->getPeerInfo());
    }

    public function testGetRawChangeAddress()
    {
        $this->assertTrue($this->bitcoinRPC->getRawChangeAddress('account'));
    }

    public function testGetRawMemPool()
    {
        $this->assertTrue($this->bitcoinRPC->getRawMemPool());
    }

    public function testGetRawTransaction()
    {
        $this->assertTrue($this->bitcoinRPC->getRawTransaction('txid', 1));
    }

    public function testGetReceivedByAccount()
    {
        $this->assertTrue($this->bitcoinRPC->getReceivedByAccount('account', 1));
    }

    public function testGetReceivedByAddress()
    {
        $this->assertTrue($this->bitcoinRPC->getReceivedByAddress('address', 1));
    }

    public function testGetTransaction()
    {
        $this->assertTrue($this->bitcoinRPC->getTransaction('txid'));
    }

    public function testGetTxout()
    {
        $this->assertTrue($this->bitcoinRPC->getTxout('txid', 1, true));
    }

    public function testGetTxoutSetInfo()
    {
        $this->assertTrue($this->bitcoinRPC->getTxoutSetInfo());
    }

    public function testGetWork()
    {
        $this->assertTrue($this->bitcoinRPC->getWork('data'));
    }

    public function testHelp()
    {
        $this->assertTrue($this->bitcoinRPC->help('command'));
    }

    public function testImportPrivKey()
    {
        $this->assertTrue($this->bitcoinRPC->importPrivKey('privKey', 'label', true));
    }

    public function testInvalidateBlock()
    {
        $this->assertTrue($this->bitcoinRPC->invalidateBlock('hash'));
    }

    public function testKeypoolRefill()
    {
        $this->assertTrue($this->bitcoinRPC->keypoolRefill());
    }

    public function testListAddressGroupings()
    {
        $this->assertTrue($this->bitcoinRPC->listAddressGroupings());
    }

    public function testListReceivedByAccount()
    {
        $this->assertTrue($this->bitcoinRPC->listReceivedByAccount(1, 1));
    }

    public function testListTransactions()
    {
        $this->assertTrue($this->bitcoinRPC->listTransactions('account', 1, 'from'));
    }

    public function testListUnspent()
    {
        $this->assertTrue($this->bitcoinRPC->listUnspent(1, 10));
    }

    public function testListLockUnspent()
    {
        $this->assertTrue($this->bitcoinRPC->listLockUnspent());
    }

    public function testLockUnspent()
    {
        $this->assertTrue($this->bitcoinRPC->lockUnspent('unlock', [1]));
    }

    public function testMove()
    {
        $this->assertTrue($this->bitcoinRPC->move('from', 'to', 123, 1, 'comment'));
    }

    public function testSendFrom()
    {
        $this->assertTrue($this->bitcoinRPC->sendFrom('from', 'to', 123, 1, 'comment', 'commentTo'));
    }

    public function testSendMany()
    {
        $this->assertTrue($this->bitcoinRPC->sendMany('from', 'to', 123, 'comment'));
    }

    public function testSendRawTransaction()
    {
        $this->assertTrue($this->bitcoinRPC->sendRawTransaction('string'));
    }

    public function testSetAccount()
    {
        $this->assertTrue($this->bitcoinRPC->setAccount('address', 'account'));
    }

    public function testSetGenerate()
    {
        $this->assertTrue($this->bitcoinRPC->setGenerate('generate', 5));
    }

    public function testSetTxFee()
    {
        $this->assertTrue($this->bitcoinRPC->setTxFee(123));
    }

    public function testSignMessage()
    {
        $this->assertTrue($this->bitcoinRPC->signMessage('address', 'message'));
    }

    public function testSignRawTransaction()
    {
        $this->assertTrue($this->bitcoinRPC->signRawTransaction('hex', 'message', 'keys'));
    }

    public function testStop()
    {
        $this->assertTrue($this->bitcoinRPC->stop());
    }

    public function testSubmitBlock()
    {
        $this->assertTrue($this->bitcoinRPC->submitBlock('hex', 'params'));
    }

    public function testListReceivedByAddress()
    {
        $this->assertTrue($this->bitcoinRPC->listReceivedByAddress(1, 5));
    }

    public function testListSinceBlock()
    {
        $this->assertTrue($this->bitcoinRPC->listSinceBlock('hash', 'target'));
    }

    public function testSendToAddress()
    {
        $this->assertTrue($this->bitcoinRPC->sendToAddress('address', 123, 'comment', 'commentTo'));
    }

    public function testValidateAddress()
    {
        $this->assertTrue($this->bitcoinRPC->validateAddress('address'));
    }

    public function testVerifyMessage()
    {
        $this->assertTrue($this->bitcoinRPC->verifyMessage('address', 'signature', 'message'));
    }

    public function testWalletLock()
    {
        $this->assertTrue($this->bitcoinRPC->walletLock());
    }

    public function testWalletPassPhrase()
    {
        $this->assertTrue($this->bitcoinRPC->walletPassPhrase('passPhrase', 1000));
    }

    public function testWalletPassPhraseChange()
    {
        $this->assertTrue($this->bitcoinRPC->walletPassPhraseChange('oldPassPhrase', 'newPassPhrase'));
    }
}
