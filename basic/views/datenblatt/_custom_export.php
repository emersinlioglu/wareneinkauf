<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal-export">
    Launch demo modal
</button>
<div id="myModal-export" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">&nbsp;</h4>
            </div>
            <div class="modal-body">
                <?php
echo '<label class="control-label">Felder</label>';
echo Select2::widget([
    'name' => 'fields[]',
    'data' => ArrayHelper::map($gridColumns, 'value', 'label'),
    'options' => [
        'placeholder' => 'Felder wählen',
        'multiple' => true
    ],
]);
?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
            </div>
        </div>

    </div>
</div>

    <?= Html::submitButton('Exportieren', ['name' => 'submitSelection', 'value' => 'selection'],['target'=>'_blank']) ?>
<?php ActiveForm::end(); ?>

<?php $form = ActiveForm::begin([
    'action' => ['abschlag/serienbrief'],
    'method' => 'post',
    'options' => array(
        'class' => 'datenblatt-selection-form hide',
    )
]); ?>
    <?= Html::submitButton('submitSelection', ['name' => 'submitSelection', 'value' => 'selection']) ?>
<?php ActiveForm::end(); ?>
