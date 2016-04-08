<div>
    <?php echo $this->Html->link('zurück', 'javascript:window.history.back();') ?>
    <h1><?= $file->collectionName; ?></h1>
    <body>
        <h2><?= $file->versionNumber ?></h2>
        <i><?= empty($collectionData['description']) ? '' : $collectionData['description'] ?></i>
    </body>

    <?= $this->Html->link('Download', [
        'plugin' => 'CakePostman',
        'controller' => 'Collections',
        'action' => 'downloadCollectionWithName',
        $file->name
    ], [
        'class' => 'btn btn-primary pull-right'
    ]) ?>

<!-- <<?php debug($collectionData); ?> -->

        <?php if (empty($collectionData)): ?>
            <div class="alert alert-danger"><?= ('Fehler') ?></div>
        <?php else: ?>

        <?php foreach ($collectionData as $key => $folder): ?>
            <h3><?= empty($folder['name']) ? 'Kein Ordner' : $folder['name'] ?></h3>
            <table class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>URL</th>
                        <th>Method</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($folder['requests'] as $request) : ?>
                        <tr>
                            <td width=300>
                                <?= empty($request['name']) ? 'request name' : $request['name'] ?>
                            </td>
                            <td width=800>
                                <?= empty($request['url']) ? 'url' : $this->Text->truncate($request['url']) ?>
                            </td>
                            <td>
                                <?= empty($request['method']) ? 'method' : $this->Text->truncate($request['method']) ?>
                            </td>

                            <td>
                            <?= $this->Html->link('Show', 'javascript:', [
                                'class' => 'btn btn-info pull-right show-request-detail'
                            ]) ?>
                            </td>
                        </tr>
                        <tr class="request-detail hidden" style="width:100%; background:#ccc !important;">
                            <td colspan=4>
                                <b>Description</b>
                                <br>
                                <?= empty($request['description']) ? 'Keine Description vorhanden' : $request['description'] ?>
                                <br><hr>
                                <b>Body</b><br>
                                <?= empty($request['rawModeData']) ? 'Keine Body vorhanden' : nl2br($request['rawModeData']) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
            <?php endforeach; ?>
        <?php endif; ?>

</div>
