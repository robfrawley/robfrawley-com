<?php
/*
 * This file is part of the Rob Frawley application
 *
 * (c) Rob Frawley 2nd <rmf@robfrawley.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rf\BlogBundle\Controller;

/**
 * MediaBrowserController
 */
class MediaBrowserController extends AbstractController
{
    /**
     * @var string|null
     */
    private $root = null;

    /**
     * @param $root string|null
     * @return $this
     */
    public function setRoot($root = null)
    {
        $this->root = $root;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRoot()
    {
        return $this->root;
    }

    public function scanDir()
    {
        return @scandir($this->getRoot(), SCANDIR_SORT_ASCENDING);
    }

    /**
     * na files browser
     */
    public function naAction($dirpath)
    {
        $dirpathfixed = str_replace('|', DIRECTORY_SEPARATOR, $dirpath);
        $this->setRoot(__DIR__.'/../../../../web/na/'.$dirpathfixed);

        $this->exploreRoot();

        $bread = explode('|', urldecode($dirpath));
        for($i = 0; $i < count($bread); $i++) {
            if (empty($bread[$i])) {
                unset($bread[$i]);
            }
        }

        return $this->render(
            'RfBlogBundle:MediaBrowser:na.html.twig', [ 
                'dirs' => $this->dirs,
                'files' => $this->files,
                'path' => $dirpath,
                'bread' => $bread
            ]
        );
    }

    /**
     * na files browser
     */
    public function naDownloadAction($dirpath)
    {
        $dirpathfixed = str_replace('|', DIRECTORY_SEPARATOR, $dirpath);
        $webRoot = '/na/'.$dirpathfixed;
        $webRoot = str_ireplace('//', '/', $webRoot);

        return $this->redirect('http://robfrawley.com'.$webRoot);
    }

    public function exploreRoot()
    {
        $root = $this->getRoot();
        $this->files = [];
        $this->dirs  = [];

        $dirscan = $this->scanDir();
        
        if (!is_array($dirscan) || !count($dirscan) > 0) {
            return;
        }

        foreach ($dirscan as $entry) {

            if ($entry == '.' || $entry == '..' || $entry == 'exts.txt' || $entry == 'files.txt') continue;

            $path = $root.DIRECTORY_SEPARATOR.$entry;
            $safepath = str_replace($this->getRoot(), '', $path);

            if (substr($safepath, 0, 1) === DIRECTORY_SEPARATOR) {
                $safepath = substr($safepath, 1);
            }

            if (is_dir($path)) {
                $this->dirs[] = $safepath;
            } elseif (is_file($path)) {
                $this->files[] = $safepath;
            }
        }
    }
}
