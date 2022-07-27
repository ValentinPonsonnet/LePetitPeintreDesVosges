<?php

namespace App\Repository;

use App\Entity\Peinture;
use App\Entity\Categorie;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Peinture>
 *
 * @method Peinture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Peinture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Peinture[]    findAll()
 * @method Peinture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PeintureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Peinture::class);
    }

    public function add(Peinture $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Peinture $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Peinture[] Retourne un array de l'objet Peinture
     */
    public function lastTree(int $nb=0) // Je type pour m'assurer que je récupère un nombre
    {
        return $this->createQueryBuilder('p') // Création de la requête
        ->orderBy('p.id', 'DESC') // On trie du plus récent au plus ancien
        ->setMaxResults($nb) // On récupère la variable
        ->getQuery() // On execute la requête
        ->getResult(); // On demande le résultat
    }

    public function findAllPortefolio(Categorie $categorie): array
    {
        return $this->createQueryBuilder('p')
        ->where(':categorie MEMBER OF p.categorie')
        ->andWhere('p.portefolio = TRUE')
        ->setParameter('categorie', $categorie)
        ->getQuery()
        ->getResult();
    }
}
