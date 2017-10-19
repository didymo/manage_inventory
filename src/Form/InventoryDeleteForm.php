<?php
namespace Drupal\manage_inventory\Form;
use Drupal\Core\Entity\ContentEntityConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
/**
 * Provides a form for deleting a manage_inventory entity.
 *
 * @ingroup manage_inventory
 */
class InventoryDeleteForm extends ContentEntityConfirmFormBase {
    /**
     * {@inheritdoc}
     */
    public function getQuestion() {
        return $this->t('Are you sure you want to delete entity %name?', array('%name' => $this->entity->label()));
    }
    /**
     * {@inheritdoc}
     *
     * If the delete command is canceled, return to the contact list.
     */
    public function getCancelURL() {
        return new Url('entity.content_entity_manage_inventory.collection');
    }
    /**
     * {@inheritdoc}
     */
    public function getConfirmText() {
        return $this->t('Delete');
    }
    /**
     * {@inheritdoc}
     *
     * Delete the entity and log the event. log() replaces the watchdog.
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        $entity = $this->getEntity();
        $entity->delete();
        \Drupal::logger('manage_inventory')->notice('@type: deleted %title.',
            array(
                '@type' => $this->entity->bundle(),
                '%title' => $this->entity->label(),
            ));
        $form_state->setRedirect('entity.content_entity_manage_inventory.collection');
    }
}
?>