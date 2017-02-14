<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Playlist
 *
 * @ORM\Table(name="playlist")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlaylistRepository")
 */
class Playlist
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @ORM\ManyToMany(targetEntity="Track", mappedBy="playlists")
     */
    private $tracks;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tracks = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add track
     *
     * @param \AppBundle\Entity\Track $track
     *
     * @return Playlist
     */
    public function addTrack(\AppBundle\Entity\Track $track)
    {
        $track->addPlaylist($this);
        $this->tracks[] = $track;

        return $this;
    }

    /**
     * Remove track
     *
     * @param \AppBundle\Entity\Track $track
     */
    public function removeTrack(\AppBundle\Entity\Track $track)
    {
        $this->tracks->removeElement($track);
    }

    /**
     * Get tracks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTracks()
    {
        return $this->tracks;
    }
}
