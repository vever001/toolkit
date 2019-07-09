<?php

namespace EcEuropa\Toolkit\TaskRunner\Commands;

use OpenEuropa\TaskRunner\Commands\AbstractCommands;

/**
 * Generic tools.
 */
class ToolCommands extends AbstractCommands {

  /**
   * Disable aggregation and clear cache.
   *
   * @command toolkit:disable-drupal-cache
   *
   * @return \Robo\Collection\CollectionBuilder
   *   Collection builder.
   */
  public function disableDrupalCache() {
    $tasks = [];

    $tasks[] = $this->taskExecStack()
      ->stopOnFail()
      ->exec('./vendor/bin/drush -y config-set system.performance css.preprocess 0')
      ->exec('./vendor/bin/drush -y config-set system.performance js.preprocess 0')
      ->exec('./vendor/bin/drush cache:rebuild');

    // Build and return task collection.
    return $this->collectionBuilder()->addTaskList($tasks);
  }

}
