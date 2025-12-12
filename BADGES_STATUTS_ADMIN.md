# Badges de Statuts - Dashboard Admin

## Vue d'ensemble des couleurs

### 🟡 Pending (En attente)
- **Couleur de fond** : `rgba(255, 187, 0, 0.1)` (jaune clair)
- **Couleur du texte** : `#d97706` (orange)
- **Classe CSS** : `.status-badge.pending`

### 🔵 In Review (En évaluation)
- **Couleur de fond** : `rgba(59, 130, 246, 0.1)` (bleu clair)
- **Couleur du texte** : `#2563eb` (bleu)
- **Classe CSS** : `.status-badge.in-review`

### 🟢 Accepted (Accepté/Validé/Actif)
- **Couleur de fond** : `rgba(16, 185, 129, 0.1)` (vert clair)
- **Couleur du texte** : `#059669` (vert)
- **Classe CSS** : `.status-badge.accepted`

### 🔴 Rejected (Rejeté/Refusé/Suspendu)
- **Couleur de fond** : `rgba(239, 68, 68, 0.1)` (rouge clair)
- **Couleur du texte** : `#dc2626` (rouge)
- **Classe CSS** : `.status-badge.rejected`

### 🟣 Published (Publié)
- **Couleur de fond** : `rgba(139, 92, 246, 0.1)` (violet clair)
- **Couleur du texte** : `#7c3aed` (violet)
- **Classe CSS** : `.status-badge.published`

---

## Mapping des statuts par type

### 📄 Articles

| Statut DB | Badge | Classe CSS |
|-----------|-------|------------|
| `soumis` | Soumis | `pending` |
| `en_attente` | En attente | `pending` |
| `en évaluation` / `en_evaluation` | En évaluation | `in-review` |
| `accepté` / `accepte` / `valide` | Accepté | `accepted` |
| `publié` / `publie` | Publié | `published` |
| `rejeté` / `rejete` / `refuse` | Rejeté | `rejected` |

### 💳 Paiements

| Statut DB | Badge | Classe CSS |
|-----------|-------|------------|
| `en_attente` | En attente | `pending` |
| `valide` | Validé | `accepted` |
| `refuse` / `refusé` | Refusé | `rejected` |

### 👤 Utilisateurs

| Statut DB | Badge | Classe CSS |
|-----------|-------|------------|
| `actif` | Actif | `accepted` |
| `suspendu` | Suspendu | `rejected` |
| `en_attente` | En attente | `pending` |

### 📋 Abonnements

| Statut DB | Badge | Classe CSS |
|-----------|-------|------------|
| `actif` | Actif | `accepted` |
| `en_attente` | En attente | `pending` |
| `refuse` / `refusé` | Refusé | `rejected` |
| `expire` / `expiré` | Expiré | `rejected` |

---

## Utilisation dans les vues

### Méthode 1 : Fonction helper (recommandée)

```php
<?php
// Génère automatiquement le badge avec la bonne classe et le texte formaté
echo statusBadge($article['statut'], 'article');
echo statusBadge($paiement['statut'], 'paiement');
echo statusBadge($user['statut'], 'user');
echo statusBadge($abonnement['statut'], 'abonnement');
?>
```

### Méthode 2 : Classe CSS uniquement

```php
<?php
$badgeClass = getStatusBadgeClass($statut, 'article');
$badgeText = formatStatusText($statut);
?>
<span class="status-badge <?= $badgeClass ?>"><?= htmlspecialchars($badgeText) ?></span>
```

### Méthode 3 : Directement dans le HTML

```php
<span class="status-badge <?= getStatusBadgeClass($item['statut'], 'article') ?>">
    <?= htmlspecialchars(formatStatusText($item['statut'])) ?>
</span>
```

---

## Exemples visuels

### Articles
- 🟡 **Soumis** - Badge jaune/orange
- 🔵 **En évaluation** - Badge bleu
- 🟢 **Accepté** - Badge vert
- 🟣 **Publié** - Badge violet
- 🔴 **Rejeté** - Badge rouge

### Paiements
- 🟡 **En attente** - Badge jaune/orange
- 🟢 **Validé** - Badge vert
- 🔴 **Refusé** - Badge rouge

### Utilisateurs
- 🟢 **Actif** - Badge vert
- 🔴 **Suspendu** - Badge rouge
- 🟡 **En attente** - Badge jaune/orange

---

## Notes

- Tous les statuts sont normalisés en minuscules avant le mapping
- Les variantes (avec/sans accents, avec/sans underscores) sont toutes prises en compte
- Si un statut n'est pas reconnu, il utilise la classe `pending` par défaut
- Le texte est automatiquement formaté avec la première lettre en majuscule

