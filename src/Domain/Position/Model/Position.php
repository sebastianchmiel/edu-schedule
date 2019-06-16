<?php

namespace App\Domain\Position\Model;

/**
 * Single position (item)
 *
 * @author Sebastian Chmiel
 */
class Position {
    
    /**
     * url for item details
     * @var string|null
     */
    private $url;
    
    /**
     * title
     * @var string|null
     */
    private $title;
    
    /**
     * image source
     * @var string|null
     */
    private $img;
    
    /**
     * rating value
     * @var float|null
     */
    private $rating;
    
    /**
     * rating votes
     * @var int|null
     */
    private $ratingVotes;
    
    /**
     * length (in munutes or pages)
     * @var int|null
     */
    private $length;
    
    /**
     * author name
     * @var string|null
     */
    private $author;
    
    /**
     * lector name
     * @var string|null
     */
    private $lector;
    
    /**
     * category name
     * @var string|null
     */
    private $category;
    
    /**
     * description
     * @var string|null
     */
    private $description;
    
    
    /**
     * set url
     * @param string|null $url
     * @return \self
     */
    public function setUrl(?string $url): self {
        $this->url = $url;
        return $this;
    }
    
    /**
     * set title
     * @param string|null $title
     * @return \self
     */
    public function setTitle(?string $title): self {
        $this->title = $title;
        return $this;
    }
    
    /**
     * set img
     * @param string|null $img
     * @return \self
     */
    public function setImg(?string $img): self {
        $this->img = $img;
        return $this;
    }
    
    /**
     * set rating
     * @param float|null $rating
     * @return \self
     */
    public function setRating(?float $rating): self {
        $this->rating = $rating;
        return $this;
    }
    
    /**
     * set rating votes
     * @param int|null $ratingVotes
     * @return \self
     */
    public function setRatingVotes(?int $ratingVotes): self {
        $this->ratingVotes = $ratingVotes;
        return $this;
    }
    
    /**
     * set length
     * @param int|null $length
     * @return \self
     */
    public function setLength(?int $length): self {
        $this->length = $length;
        return $this;
    }
    
    /**
     * set author
     * @param string|null $author
     * @return \self
     */
    public function setAuthor(?string $author): self {
        $this->author = $author;
        return $this;
    }
    
    /**
     * set lector
     * @param string|null $lector
     * @return \self
     */
    public function setLector(?string $lector): self {
        $this->lector = $lector;
        return $this;
    }
    
    /**
     * set category
     * @param string|null $category
     * @return \self
     */
    public function setCategory(?string $category): self {
        $this->category = $category;
        return $this;
    }
    
    /**
     * set description
     * @param string|null $description
     * @return \self
     */
    public function setDescription(?string $description): self {
        $this->description = $description;
        return $this;
    }
}
