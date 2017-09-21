<?php
namespace Admin\BlogBundle\EventListener;

use Admin\BlogBundle\Entity\Article;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class CoverUploadListener
 *
 * @package Admin\BlogBundle\EventListener
 */
class CoverUploadListener
{
    /**
     * On post load Article
     * Replace cover string with file type
     *
     * @param LifecycleEventArgs $args
     */
    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof Article) {
            return;
        }

        if ($fileName = $entity->getCover()) {
            $entity->setFile(new File($entity->getCoverAbsolutePath()));
        }
    }

    /**
     * On pre persist doctrine event
     *
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    /**
     * On pre update doctrine event
     *
     * @param PreUpdateEventArgs $args
     */
    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    /**
     * Upload file
     *
     * @param $entity
     */
    private function uploadFile($entity)
    {
        // upload only works for Article entities
        if (!$entity instanceof Article) {
            return;
        }

        $file = $entity->getFile();

        $fileName = null;

        // only upload new files
        if ($file instanceof UploadedFile) {
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            $file->move($entity->getCoverUploadDirectory(), $fileName);
        }

        if($fileName !== null) {
            $entity->setCover($fileName);
        }
    }
}