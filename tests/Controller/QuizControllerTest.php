<?php

namespace App\Test\Controller;

use App\Entity\Quiz;
use App\Repository\QuizRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class QuizControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private QuizRepository $repository;
    private string $path = '/quiz/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Quiz::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Quiz index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'quiz[Titre]' => 'Testing',
            'quiz[Description]' => 'Testing',
            'quiz[Image]' => 'Testing',
            'quiz[updatedAt]' => 'Testing',
            'quiz[users]' => 'Testing',
        ]);

        self::assertResponseRedirects('/quiz/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Quiz();
        $fixture->setTitre('My Title');
        $fixture->setDescription('My Title');
        $fixture->setImage('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setUsers('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Quiz');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Quiz();
        $fixture->setTitre('My Title');
        $fixture->setDescription('My Title');
        $fixture->setImage('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setUsers('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'quiz[Titre]' => 'Something New',
            'quiz[Description]' => 'Something New',
            'quiz[Image]' => 'Something New',
            'quiz[updatedAt]' => 'Something New',
            'quiz[users]' => 'Something New',
        ]);

        self::assertResponseRedirects('/quiz/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTitre());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getImage());
        self::assertSame('Something New', $fixture[0]->getUpdatedAt());
        self::assertSame('Something New', $fixture[0]->getUsers());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Quiz();
        $fixture->setTitre('My Title');
        $fixture->setDescription('My Title');
        $fixture->setImage('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setUsers('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/quiz/');
    }
}
