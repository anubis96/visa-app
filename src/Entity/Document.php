<?php

namespace App\Entity;

use App\Repository\DocumentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: DocumentRepository::class)]
#[Vich\Uploadable]
class Document
{
    public const CATEGORIES = [
        'travail' => 'Documents de travail',
        'residence' => 'Document de résidence',
        'invitation' => 'Invitation de voyage',
        'motif' => 'Motif de voyage',
        'passeport' => 'Passeport (scan)',
        'civil' => 'Document civil et familial',
        'autre' => 'Autre',
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $categorie = null;

    #[Vich\UploadableField(mapping: 'documents', fileNameProperty: 'nomFichier', size: 'fichierSize')]
    private ?File $fichierFile = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nomFichier = null;

    #[ORM\Column(nullable: true)]
    private ?int $fichierSize = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'documents')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function __construct()
    {
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getId(): ?int { return $this->id; }

    public function getCategorie(): ?string { return $this->categorie; }
    public function setCategorie(string $categorie): static { $this->categorie = $categorie; return $this; }

    public function getCategorieLabel(): string
    {
        return self::CATEGORIES[$this->categorie] ?? $this->categorie;
    }

    public function setFichierFile(?File $fichierFile = null): static
    {
        $this->fichierFile = $fichierFile;
        if (null !== $fichierFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
        return $this;
    }

    public function getFichierFile(): ?File { return $this->fichierFile; }

    public function setNomFichier(?string $nomFichier): static { $this->nomFichier = $nomFichier; return $this; }
    public function getNomFichier(): ?string { return $this->nomFichier; }

    public function setFichierSize(?int $fichierSize): static { $this->fichierSize = $fichierSize; return $this; }
    public function getFichierSize(): ?int { return $this->fichierSize; }

    public function getUpdatedAt(): ?\DateTimeImmutable { return $this->updatedAt; }

    public function getUser(): ?User { return $this->user; }
    public function setUser(?User $user): static { $this->user = $user; return $this; }
}
