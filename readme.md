# LePetitPeintreDesVosges

Le Site LePeintreDesVosges vendant des tableaux sur les paysages vosgiens

## Environnement de developpement

### Pré-requis

* PHP 7.4
* Composer
* Symfony CLI
* Doctrine

Verifier les pré-requis avec la commande symfony CLI

```bash
symfony check:requirements
```

### Lancer l'environnement de developpment 

```bash
symfony server:start
symfony server:stop pour arreter le serveur
````
## Jouer les fixtures 

```bash
symfony console doctrine:fixtures:load
````