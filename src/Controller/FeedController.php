<?php

namespace App\Controller;

use App\Feed;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FeedRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @author Michael Phillips <michael.phillips@realpage.com>
 */
class FeedController extends Controller
{
    /** @var FeedRepository */
    private $repository;

    /**
     * @param FeedRepository $repository
     */
    public function __construct(FeedRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/feeds", name="feeds")
     */
    public function feeds(FeedRepository $repository)
    {
        $feeds = $repository->findAll();

        return $this->render('feeds.html.twig', [
            'feeds' => $feeds,
        ]);
    }

    /**
     * @Route("/{feed}/{entry}", name="entry")
     */
    public function entry(string $feed, string $entry)
    {
        $feed = $this->repository->findOneByUrl(urldecode($feed));

        if (null === $feed) {
            throw new NotFoundHttpException();
        }

        $entry = $feed->findEntryByName(urldecode($entry));

        if (null === $entry) {
            throw new NotFoundHttpException();
        }

        return $this->render('entry.html.twig', [
            'feed' => $feed,
            'entry' => $entry,
        ]);
    }
}
