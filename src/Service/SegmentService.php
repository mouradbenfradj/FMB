<?php

namespace App\Service;

use App\Entity\Asc\FiliereComposite\Segment;
use App\Repository\Asc\FiliereComposite\SegmentRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Contracts\Cache\CacheInterface;

class SegmentService
{
    private $cache;
    private $segmentRepository;

    public function __construct(
        SegmentRepository $segmentRepository,
        CacheInterface $cache
    ) {
        $this->cache = $cache;
        $this->segmentRepository = $segmentRepository;
    }
    /**
     * @return Segment[] Tableau des objets Parc
     */
    public function getSegments(int $id)
    {
        return $this->segmentRepository->findByFiliere($id);
    }
}
