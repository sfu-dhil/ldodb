<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Command;

use App\Entity\Book;
use App\Repository\BookRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Twig\Environment;

class ExportModsCommand extends Command {
    /**
     * @var BookRepository
     */
    private $bookRepo;
    /**
     * @var Environment
     */
    private $twig;

    protected static $defaultName = 'ldodb:export:mods';

    protected function configure() : void {
        $this
            ->setDescription('Export metadata from the database')
            ->addArgument('dir', InputArgument::REQUIRED, 'Directory to export to')
        ;
    }

    /**
     * @param Book $book
     * @param $path
     */
    protected function export($book, $path) : void {
        $filename = $book->getFileName();
        $xml = $this->twig->render('export/mods.xml.twig', ['book' => $book]);
        file_put_contents("{$path}/{$filename}.xml", $xml);
    }

    protected function execute(InputInterface $input, OutputInterface $output) : int {
        $path = $input->getArgument('dir');
        if ( ! file_exists($path)) {
            mkdir($path);
        }

        foreach ($this->bookRepo->findAll() as $book) {
            $this->export($book, $path);
        }

        return 0;
    }

    /**
     * @required
     */
    public function setBookRepository(BookRepository $repository) : void {
        $this->bookRepo = $repository;
    }

    /**
     * @required
     */
    public function setEnvironment(Environment $twig) : void {
        $this->twig = $twig;
    }
}
