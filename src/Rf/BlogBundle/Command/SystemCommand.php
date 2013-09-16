<?php
/*
 * This file is part of the Scribe World Application.
 *
 * (c) Scribe Inc. <scribe@scribenet.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rf\BlogBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Output\OutputInterface;
use Swift_Message,
    Datetime;

/**
 * Class SystemCommand
 * @package Scribe\SharedBundle\Command
 */
class SystemCommand extends ContainerAwareCommand
{
    private $saveRoot = '/tmp/naarchive/';

    private $files = [];
    private $exts  = [];
    private $downloads = [];

    /**
     * @see Command
     */
    protected function configure()
    {
        $this
            ->setName('gcna:history:get')
            ->setDescription('Get all files from http://narchive.magshare.net/');
    }

    /**
     * @param  \Symfony\Component\Console\Input\InputInterface   $input
     * @param  \Symfony\Component\Console\Output\OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $url  = 'http://narchive.magshare.net/?dir=/';
        $root = 'NArchive';
        $output->writeln('<info>Reading from '.$url.' with root directory '.$root.'</info>');

        $this->readUrl($url, [$root], $output, true);
        $this->doFileDownloads();

        $output->writeln('<info>Files:'.print_r($this->files).'</info>');
        $output->writeln('<info>Extensions:'.print_r($this->exts).'</info>');

        file_put_contents($this->saveRoot.'files.txt', print_r($this->files, true));
        file_put_contents($this->saveRoot.'exts.txt', print_r($this->exts, true));
    }

    private function readUrl($url, $where, OutputInterface $output, $l1 = false)
    {
$this->output = $output;

        if (! file_exists($this->saveRoot)) {
            mkdir($this->saveRoot, 0775, true);
        }

        //$progress = $this->getHelperSet()->get('progress');

        $root = urlencode(implode('/', $where));
        //$output->writeln('Reading '.$root);

        $content = file_get_contents($url.$root);

        $patternD = '#<a href="\?dir=(.*?)" class="(.*?)">(.*?)</a>#i';
        $patternF = '#<a href="(.*?)" class="(.*?)">(.*?)</a>#i';

        preg_match_all($patternD, $content, $matches);
        preg_match_all($patternF, $content, $matchesF);
//        print_r($matchesF);
        if ($l1 === true) {
            //$progress->start($output, count($matches[0]));
        }

        for ($i = 0; $i < count($matches[0]); $i++) {
            $filepath = $matches[1][$i];
            $types    = explode(' ', $matches[2][$i]);
            if (in_array('dir', $types)) {
                $dir = $matches[3][$i];
                $newWhere = $where;
                $newWhere[] = $dir;
                $this->readUrl($url, $newWhere, $output, false);
            }

            if ($l1 === true) {
                //$progress->advance();
            }

        }
        
        if (count($matchesF[0]) > 0) {
            $output->writeln('<info>Scanning files in: "'.implode('/', $where).'"</info>');
            for ($i = 0; $i < count($matchesF[0]); $i++) {
                $filepath = $matchesF[1][$i];
                $types    = explode(' ', $matchesF[2][$i]);
                if (in_array('file', $types)) {
                    $file = $matchesF[3][$i];
		    if ($file !== 'Thumbs.db') {
	                $newWhere = $where;
        	        $newWhere[] = $file;
                        $this->getFile($filepath, $newWhere);
		    }
                }
                
            }
            
        }

        if ($l1 === true) {
            //$progress->finish();
        }

    }

    private function makeDirectory($where)
    {
        $dirpath = pathinfo($where, PATHINFO_DIRNAME);
        if (! file_exists($dirpath)) {
            mkdir($dirpath, 0775, true);
        }
    }

    private function saveFile($where, $file)
    {
        //$this->makeDirectory($where);
        $dirpath = $this->saveRoot . implode(DIRECTORY_SEPARATOR, $where);
        //file_put_contents($dirpath = $this->saveRoot . implode(DIRECTORY_SEPARATOR, $where), file_get_contents('http://narchive.magshare.net/'.$file));
        $this->downloadsTo[] = $dirpath;
        $this->downloads[] = 'http://narchive.magshare.net/'.$file;
    }

    private function doFileDownloads()
    {
        $this->output->writeln('<info>Downloading '.count($this->downloads).' found files</info>');
        $progress = $this->getHelperSet()->get('progress');
        $progress->start($this->output, count($this->downloads));
        for ($i = 0; $i < count($this->downloads); $i++) {
            $this->makeDirectory($this->downloadsTo[$i]);
            $this->files[] = $this->downloadsTo[$i];
            $ext = pathinfo($this->downloadsTo[$i], PATHINFO_EXTENSION);
            if (array_key_exists($ext, $this->exts)) {
                $this->exts[$ext]++;
            } else {
                $this->exts[$ext] = 1;
            }
            file_put_contents($this->downloadsTo[$i], file_get_contents($this->downloads[$i]));
            $progress->advance();
        }
        $progress->finish();
    }

    private function getFile($file, $where = [])
    {
        $where = $this->whereClean($where);
        $this->saveFile($where, $file);
    }

    private function whereClean($where = [])
    {
        array_shift($where);

        for ($i = 0; $i < count($where); $i++) {
            $where[$i] = ucwords( $where[$i] );
            $where[$i] = preg_replace( '/\s+/', ' ', trim( $where[$i] ) );
            $where[$i] = preg_replace( '/\s/', '_', $where[$i] );
            $where[$i] = preg_replace( '/-+/', '-', $where[$i] );
        }

        return $where;
    }
}
