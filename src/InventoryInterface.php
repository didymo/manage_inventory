<?php
namespace Drupal\manage_inventory;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;
use Drupal\Core\Entity\EntityChangedInterface;
/**
 * Provides an interface defining a Inventory entity.
 * @ingroup manage_inventory
 */
interface InventoryInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {
}
?>