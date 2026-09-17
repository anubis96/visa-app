<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: 'app_user')]
#[ORM\UniqueConstraint(name: 'UNIQ_EMAIL', fields: ['email'])]
#[ORM\UniqueConstraint(name: 'UNIQ_PASSEPORT', fields: ['numeroPasseport'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\NotBlank]
    #[Assert\Email]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 50, unique: true)]
    #[Assert\NotBlank]
    private ?string $numeroPasseport = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank]
    private ?string $nom = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank]
    private ?string $prenom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateNaissance = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $lieuNaissance = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $nationalite = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $sexe = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateEmission = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateExpiration = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $paysEmission = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $telephone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adresse = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $ville = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $pays = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $codePostal = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $profession = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $situationFamiliale = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToMany(targetEntity: Document::class, mappedBy: 'user', orphanRemoval: true, cascade: ['persist'])]
    private Collection $documents;

    public function __construct()
    {
        $this->documents = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
        $this->roles = ['ROLE_USER'];
    }

    public function getId(): ?int { return $this->id; }

    public function getEmail(): ?string { return $this->email; }
    public function setEmail(string $email): static { $this->email = $email; return $this; }

    public function getUserIdentifier(): string { return (string) $this->email; }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }
    public function setRoles(array $roles): static { $this->roles = $roles; return $this; }

    public function getPassword(): string { return $this->password; }
    public function setPassword(string $password): static { $this->password = $password; return $this; }

    public function eraseCredentials(): void {}

    public function getNumeroPasseport(): ?string { return $this->numeroPasseport; }
    public function setNumeroPasseport(string $numeroPasseport): static { $this->numeroPasseport = $numeroPasseport; return $this; }

    public function getNom(): ?string { return $this->nom; }
    public function setNom(string $nom): static { $this->nom = $nom; return $this; }

    public function getPrenom(): ?string { return $this->prenom; }
    public function setPrenom(string $prenom): static { $this->prenom = $prenom; return $this; }

    public function getDateNaissance(): ?\DateTimeInterface { return $this->dateNaissance; }
    public function setDateNaissance(?\DateTimeInterface $dateNaissance): static { $this->dateNaissance = $dateNaissance; return $this; }

    public function getLieuNaissance(): ?string { return $this->lieuNaissance; }
    public function setLieuNaissance(?string $lieuNaissance): static { $this->lieuNaissance = $lieuNaissance; return $this; }

    public function getNationalite(): ?string { return $this->nationalite; }
    public function setNationalite(?string $nationalite): static { $this->nationalite = $nationalite; return $this; }

    public function getSexe(): ?string { return $this->sexe; }
    public function setSexe(?string $sexe): static { $this->sexe = $sexe; return $this; }

    public function getDateEmission(): ?\DateTimeInterface { return $this->dateEmission; }
    public function setDateEmission(?\DateTimeInterface $dateEmission): static { $this->dateEmission = $dateEmission; return $this; }

    public function getDateExpiration(): ?\DateTimeInterface { return $this->dateExpiration; }
    public function setDateExpiration(?\DateTimeInterface $dateExpiration): static { $this->dateExpiration = $dateExpiration; return $this; }

    public function getPaysEmission(): ?string { return $this->paysEmission; }
    public function setPaysEmission(?string $paysEmission): static { $this->paysEmission = $paysEmission; return $this; }

    public function getTelephone(): ?string { return $this->telephone; }
    public function setTelephone(?string $telephone): static { $this->telephone = $telephone; return $this; }

    public function getAdresse(): ?string { return $this->adresse; }
    public function setAdresse(?string $adresse): static { $this->adresse = $adresse; return $this; }

    public function getVille(): ?string { return $this->ville; }
    public function setVille(?string $ville): static { $this->ville = $ville; return $this; }

    public function getPays(): ?string { return $this->pays; }
    public function setPays(?string $pays): static { $this->pays = $pays; return $this; }

    public function getCodePostal(): ?string { return $this->codePostal; }
    public function setCodePostal(?string $codePostal): static { $this->codePostal = $codePostal; return $this; }

    public function getProfession(): ?string { return $this->profession; }
    public function setProfession(?string $profession): static { $this->profession = $profession; return $this; }

    public function getSituationFamiliale(): ?string { return $this->situationFamiliale; }
    public function setSituationFamiliale(?string $situationFamiliale): static { $this->situationFamiliale = $situationFamiliale; return $this; }

    public function getCreatedAt(): ?\DateTimeImmutable { return $this->createdAt; }
    public function getUpdatedAt(): ?\DateTimeImmutable { return $this->updatedAt; }
    public function setUpdatedAt(): static { $this->updatedAt = new \DateTimeImmutable(); return $this; }

    /** @return Collection<int, Document> */
    public function getDocuments(): Collection { return $this->documents; }

    public function addDocument(Document $document): static
    {
        if (!$this->documents->contains($document)) {
            $this->documents->add($document);
            $document->setUser($this);
        }
        return $this;
    }

    public function removeDocument(Document $document): static
    {
        if ($this->documents->removeElement($document)) {
            if ($document->getUser() === $this) {
                $document->setUser(null);
            }
        }
        return $this;
    }

    /**
     * Pourcentage de complétion du profil (hors documents), utilisé pour "Compléter mon dossier".
     */
    public function getTauxCompletion(): int
    {
        $champs = [
            $this->dateNaissance, $this->lieuNaissance, $this->nationalite, $this->sexe,
            $this->dateEmission, $this->dateExpiration, $this->paysEmission,
            $this->telephone, $this->adresse, $this->ville, $this->pays, $this->codePostal,
            $this->profession, $this->situationFamiliale,
        ];
        $remplis = count(array_filter($champs, fn ($v) => $v !== null && $v !== ''));
        return (int) round(($remplis / count($champs)) * 100);
    }
}
