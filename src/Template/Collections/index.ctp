<div>
    <h1><?= $projectName . ' - Collections' ?> </h1>
        <?php if (! empty($invalidCollections)): ?>
            <div class="alert alert-danger"><?= ($error) ?></div>
        <?php endif ?>

        <?php if (empty($collections)): ?>

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
                                <tr>
                                    <td>
                                        <?= $collection->buildNumber ?>
                                    </td>

                                        <td>
                                        <?= $collection->created ?>
                                    </td>
                                    <td>
                                        <div class="pull-right">
                                            <?= $this->Html->link('View', [
                                                'plugin' => 'CakePostman',
                                                'controller' => 'Collections',
                                                'action' => 'view',
                                                $collection->name
                                            ], [
                                                'class' => 'btn btn-primary'
                                            ]) ?>

                                            &nbsp;

                                            <?= $this->Html->link('Download', [
                                                'plugin' => 'CakePostman',
                                                'controller' => 'Collections',
                                                'action' => 'downloadFileWithName',
                                                $collection->name
                                            ], [
                                                'class' => 'btn btn-primary'
                                            ]) ?>
                                        </div>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                </table>
            <?php endforeach; ?>
        <?php endif; ?>
</div>
