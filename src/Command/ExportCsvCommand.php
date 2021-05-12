<?php

declare(strict_types=1);

/*
 * (c) 2021 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Command;

use App\Entity\Book;
use App\Entity\Contribution;
use App\Entity\Subject;
use App\Entity\SubjectHeading;
use App\Repository\BookRepository;
use League\Csv\Writer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ExportCsvCommand extends Command {
    /**
     * @var BookRepository
     */
    private $bookRepo;

    protected static $defaultName = 'ldodb:export:csv';

    protected function configure() : void {
        $this
            ->setDescription('Export metadata from the database')
            ->addArgument('file', InputArgument::REQUIRED, 'File to export to')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) : int {
        $io = new SymfonyStyle($input, $output);
        $path = $input->getArgument('file');

        if ( ! file_exists($path)) {
            touch($path);
        }
        $csv = Writer::createFromPath($path);

        $headers = ['filename', 'contributors', 'callNumber', 'title', 'shortTitle', 'seriesTitle',
            'imprint', 'edition', 'pubDate', 'volumes', 'pages', 'bibliographicNotes',
            'subjects', 'subjectHeadings', ];
        $csv->insertOne($headers);

        foreach ($this->bookRepo->findAll() as $book) {
            /** @var Book $book */
            $data = [
                'filename' => $book->getFileName(),
                'contributors' => implode('; ', array_map(fn (Contribution $contribution) => "{$contribution->getEntity()} ({$contribution->getTask()})", $book->getContributions()->toArray())),
                'callNumber' => $book->getCallNumber(),
                'title' => $book->getTitle(),
                'shortTitle' => $book->getShortTitle(),
                'seriesTitle' => $book->getSeriesTitle(),
                'imprint' => $book->getImprint(),
                'edition' => $book->getEdition(),
                'pubDate' => $book->getPublicationDate(),
                'volumes' => $book->getVolumes(),
                'pages' => $book->getPages(),
                'bibliographicNotes' => $book->getBibliographicNotes(),
                'subjects' => implode('; ', array_map(fn (Subject $subject) => $subject->getSubjectName(), $book->getSubjects()->toArray())),
                'subjectHeadings' => implode('; ', array_map(fn (SubjectHeading $subjectHeading) => $subjectHeading->getSubjectHeading(), $book->getSubjectHeadings()->toArray())),
            ];
            $csv->insertOne($data);
        }

        return 0;
    }

    /**
     * @required
     */
    public function setBookRepository(BookRepository $repository) : void {
        $this->bookRepo = $repository;
    }
}
