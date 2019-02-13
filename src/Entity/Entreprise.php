<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EntrepriseRepository")
 */
class Entreprise
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank
	     * @Assert\Length(
	     *      min = 4,
	     *      minMessage = "Le titre doit faire au minimum {{ limit }} caractères"
	     * )
     */
    private $intitule;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex(pattern="#(rue|avenue|boulevard|impasse|allée|chemin|Quai)#",message="mauvais type de rue")
     * @Assert\Regex(pattern="#[0-9]{5}#",message="mauvais code postal")
     * @Assert\Regex(pattern="#^0#",message="mauvais numero de rue")
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=25)
     * @Assert\NotBlank(
     *      message = "Le champs activité ne peut pas etre nul"
     *  )
     */
    private $activite;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Stage", mappedBy="entreprise")
     */
    private $stages;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message = "Le champs activité ne peut pas etre nul")
      * @Assert\Url(message = "Ce n'est pas une URL type")
     */
    private $URL;

    public function __construct()
    {
        $this->stages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): self
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }


    public function getActivite(): ?string
    {
        return $this->activite;
    }

    public function setActivite(string $activite): self
    {
        $this->activite = $activite;

        return $this;
    }

    /**
     * @return Collection|Stage[]
     */
    public function getStages(): Collection
    {
        return $this->stages;
    }

    public function addStage(Stage $stage): self
    {
        if (!$this->stages->contains($stage)) {
            $this->stages[] = $stage;
            $stage->setEntreprise($this);
        }

        return $this;
    }

    public function removeStage(Stage $stage): self
    {
        if ($this->stages->contains($stage)) {
            $this->stages->removeElement($stage);
            // set the owning side to null (unless already changed)
            if ($stage->getEntreprise() === $this) {
                $stage->setEntreprise(null);
            }
        }

        return $this;
    }

    public function getURL(): ?string
    {
        return $this->URL;
    }

    public function setURL(string $URL): self
    {
        $this->URL = $URL;

        return $this;
    }
}
