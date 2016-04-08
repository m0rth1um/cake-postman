
<div>
    <h1><?= $projectName . ' - Collections' ?> </h1>

    <?php if (! empty($invalidCollections)): ?>
        <div class="alert alert-danger"><?= ($error) ?></div>
    <?php endif; ?>
    <?php if (empty($environments)): ?>
        <b><?= 'Keine Environments vorhanden' ?></b>
        <hr>
    <?php else : ?>
        <h3><?= 'Environments' ?></h3>
        <table class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>URL</th>
                    <th>Created</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($environments as $environment) : ?>
                <tr>
                    <td>
                        <?= $environment->environmentName ?>
                    </td>
                    <td>
                        <?= $environment->url ?>
                    </td>
                    <td>
                        <?= $environment->created ?>
                    </td>
                    <td>
                        <?= $this->Html->link('Download', [
                            'plugin' => 'CakePostman',
                            'controller' => 'Postman',
                            'action' => 'downloadEnvironmentWithName',
                            $environment->name
                        ], [
                            'class' => 'btn btn-primary pull-right'
                        ]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <hr>
    <?php endif; ?>

    <?php if (empty($collections)): ?>
        <b><?= 'Keine Collections vorhanden' ?></b>
    <?php else : ?>

        <?php foreach ($collections as $key => $version): ?>
            <h3><?= $version['version'] ?></h3>
            <table class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Created</th>
                    </tr>
                </thead>
                    <tbody>
                        <?php foreach ($version['collections'] as $collection) : ?>
                            <tr class="collection-row">
                                <td>
                                    <?= $collection->buildNumber ?>
                                </td>

                                <td>
                                    <?= $collection->created ?>
                                </td>
                                <td>
                                    <div class="pull-right">
                                        <?= $this->Html->link('Show', 'javascript:', [
                                            'class' => 'btn btn-info show-collection-detail'
                                        ]) ?>

                                        &nbsp;
                                        <?= $this->Html->link('View', [
                                            'plugin' => 'CakePostman',
                                            'controller' => 'Postman',
                                            'action' => 'view',
                                            $collection->name
                                        ], [
                                            'class' => 'btn btn-primary'
                                        ]) ?>

                                        &nbsp;

                                        <?= $this->Html->link('Download', [
                                            'plugin' => 'CakePostman',
                                            'controller' => 'Postman',
                                            'action' => 'downloadCollectionWithName',
                                            $collection->name
                                        ], [
                                            'class' => 'btn btn-primary'
                                        ]) ?>
                                    </div>
                                </td>

                            </tr>
                            <tr class="collection-detail hidden">
                                <td colspan=3>
                                    <?= empty($collection->collectionDescription) ? 'Keine Description vorhanden' : $collection->collectionDescription ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

            </table>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
