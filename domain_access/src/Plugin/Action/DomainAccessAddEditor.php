<?php

/**
 * @file
 * Contains \Drupal\domain_access\Plugin\Action\DomainAccessAddEditor.
 */

namespace Drupal\domain_access\Plugin\Action;

use Drupal\domain_access\Plugin\Action\DomainAccessActionBase;
use Drupal\Core\Session\AccountInterface;

/**
 * Assigns an editor to a domain.
 *
 * @Action(
 *   id = "domain_access_add_editor_action",
 *   label = @Translation("Add domain to editors"),
 *   type = "user"
 * )
 */
class DomainAccessAddEditor extends DomainAccessActionBase {

  /**
   * {@inheritdoc}
   */
  public function execute($entity = NULL) {
    $id = $this->configuration['id'];
    $user_domains = \Drupal::service('domain_access.manager')->getAccessValues($entity);
    // Skip adding the role to the user if they already have it.
    if ($entity !== FALSE && !isset($user_domains[$id])) {
      $user_domains[$id] = $id;
      $entity->set(DOMAIN_ACCESS_FIELD, array_keys($user_domains));
      $entity->save();
    }
  }

}
