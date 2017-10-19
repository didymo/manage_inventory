<?php
namespace Drupal\manage_inventory\Entity\Controller;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Url;
/**
 * Provides a list controller for content_entity_manage_inventory entity.
 *
 * @ingroup manage_inventory
 */
class InventoryListBuilder extends EntityListBuilder {
    /**
     * {@inheritdoc}
     *
     * We override ::render() so that we can add our own content above the table.
     * parent::render() is where EntityListBuilder creates the table using our
     * buildHeader() and buildRow() implementations.
     */
    public function render() {
        $build['description'] = array(
            '#markup' => $this->t('Edit Content Entity <a href="@adminlink">Here</a>.', array(
                '@adminlink' => \Drupal::urlGenerator()
                    ->generateFromRoute('manage_inventory.inventory_settings'),
            )),
        );
        $build['table'] = parent::render();
        return $build;
    }
    /**
     * {@inheritdoc}
     *
     * Building the header and content lines for the inventory list.
     *
     * Calling the parent::buildHeader() adds a column for the possible actions
     * and inserts the 'edit' and 'delete' links as defined for the entity type.
     */
    public function buildHeader() {
        $header['id'] = $this->t('Event ID');
        $header['name'] = $this->t('Event Name');
        $header['first_name'] = $this->t('Description');
        return $header + parent::buildHeader();
    }
    /**
     * {@inheritdoc}
     */
    public function buildRow(EntityInterface $entity) {
        /* @var $entity \Drupal\manage_inventory\Entity\Inventory */
        $row['id'] = $entity->id();
        $row['name'] = $entity->link();
        $row['first_name'] = $entity->first_name->value;
        return $row + parent::buildRow($entity);
    }
}
?>