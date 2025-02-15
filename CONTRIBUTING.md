# Guide de Contribution

Merci de votre intérêt pour contribuer au package Nimba SMS pour Laravel ! Voici quelques directives pour vous aider à contribuer efficacement.

## Process de Contribution

1. **Fork** le dépôt sur GitHub
2. **Clonez** votre fork localement
3. Créez une nouvelle **branche** pour vos modifications
4. **Committez** vos changements
5. **Poussez** vers votre fork
6. Soumettez une **Pull Request**

## Installation pour le Développement

1. Clonez le dépôt :
```bash
git clone https://github.com/votre-username/nimbasms.git
cd nimbasms
```

2. Installez les dépendances :
```bash
composer install
```

3. Configurez l'environnement de test :
```bash
cp .env.example .env
```

## Standards de Code

Ce package suit les standards PSR-12. Assurez-vous que votre code les respecte :

```bash
composer check-style
```

Pour corriger automatiquement le style :

```bash
composer fix-style
```

## Tests

Assurez-vous que tous les tests passent avant de soumettre une Pull Request :

```bash
composer test
```

Pour les tests avec couverture de code :

```bash
composer test-coverage
```

## Documentation

- Documentez toutes les nouvelles fonctionnalités
- Mettez à jour le README.md si nécessaire
- Ajoutez des commentaires PHPDoc pour les nouvelles méthodes
- Mettez à jour le CHANGELOG.md

## Pull Requests

1. Mettez à jour votre branche avec la dernière version de `main`
2. Incluez des tests pour les nouvelles fonctionnalités
3. Mettez à jour la documentation si nécessaire
4. Vérifiez que tous les tests passent
5. Décrivez clairement vos modifications dans la PR

### Format des Messages de Commit

Suivez le format conventionnel pour vos messages de commit :

- `feat:` Nouvelle fonctionnalité
- `fix:` Correction de bug
- `docs:` Modification de la documentation
- `style:` Formatage du code
- `refactor:` Refactorisation du code
- `test:` Ajout ou modification de tests
- `chore:` Tâches de maintenance

Exemple :
```
feat: Ajout de la fonctionnalité de programmation des SMS
```

## Signalement de Bugs

1. Utilisez le système d'issues de GitHub
2. Décrivez clairement le problème
3. Fournissez les étapes pour reproduire
4. Incluez les versions de PHP et Laravel
5. Ajoutez des logs d'erreur si disponibles

## Propositions de Fonctionnalités

1. Ouvrez une issue avec le tag "enhancement"
2. Expliquez la fonctionnalité proposée
3. Discutez de l'implémentation
4. Attendez l'approbation avant de commencer

## Sécurité

Si vous découvrez une faille de sécurité :

1. N'ouvrez PAS d'issue publique
2. Envoyez un email à [aristechdev@gmail.com](mailto:aristechdev@gmail.com)
3. Attendez une réponse avant toute divulgation

## Questions

Pour toute question :

- Ouvrez une issue avec le tag "question"
- Envoyez un email à [aristechdev@gmail.com](mailto:aristechdev@gmail.com)

## Licence

En contribuant, vous acceptez que vos contributions soient sous la même licence que le package (MIT).

## Code de Conduite

### Notre Engagement

Dans l'intérêt de favoriser un environnement ouvert et accueillant, nous nous engageons à faire de la participation à notre projet une expérience sans harcèlement pour tous.

### Comportement Attendu

- Utilisez un langage accueillant et inclusif
- Respectez les différents points de vue
- Acceptez les critiques constructives
- Concentrez-vous sur ce qui est meilleur pour la communauté
- Faites preuve d'empathie envers les autres membres

### Comportement Inacceptable

- Utilisation de langage ou d'images à caractère sexuel
- Trolling, commentaires insultants/désobligeants
- Harcèlement public ou privé
- Publication d'informations privées sans permission
- Autre conduite inappropriée dans un contexte professionnel

## Contact

- Email: aristechdev@gmail.com
- Twitter: [@ArisTechDev](https://twitter.com/ArisTechDev)
- GitHub: [ArisTech](https://github.com/aristech) 