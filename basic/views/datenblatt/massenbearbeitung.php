<?php

$this->title = 'Projektkonfiguration';
?>

<?php $form = ActiveForm::begin([
    //'enableAjaxValidation' => false,
    'enableClientValidation' => true,
    //'validateOnSubmit' => true,
    'action' => ['add-meilenstein'],
    'options' => array(
        //'class' => 'datenblatt-form',
        'id' => 'datenblatt-form'
    )
]); ?>

<div class="row">
    <div class="col-sm-4">

        <?php echo $form->field($firma, 'nr')->textInput(['disabled' => 'disabled'])->label('Buchungskr.')?>
    </div>
    <div class="col-sm-2">
        <?php echo $form->field($modelDatenblatt, 'projekt_id')->dropDownList(ArrayHelper::map($projekte, 'id', 'name'), $htmlOptions)->label('Projekt'); ?>
    </div>
</div>
<?php ActiveForm::end(); ?>



<?php

$this->registerJs('
    $(function(){
    
        // after reload form
        $(document).on("ready", function() {
            new DatenblattMassenbearbeitungForm();
        });

    });
');
?>

<style>
    .sortable {
        margin: 0 0 9px 0;
        min-height: 10px;
        border: 1px solid #cdcdcd;
    }
    .sortable li {
        cursor: move;
        display: block;
        margin: 5px;
        padding: 5px;
        border: 1px solid #cccccc;
        color: #0088cc;
        background: #eeeeee;
    }
</style>


<ol class="abschlag sortable">
    <li>
        Item 1
    </li>
    <li>
        Item 2
    </li>
    <li>
        Item 3
    </li>
    <li>
        Item 4
        <ol class="milestone sortable">
            <li>Item 3.1</li>
            <li>Item 3.2</li>
            <li>Item 3.3</li>
            <li>Item 3.4</li>
            <li>Item 3.5</li>
            <li>Item 3.6</li>
        </ol>
    </li>
    <li>
        Item 5
    </li>
    <li>
        Item 6
    </li>
</ol>

<ol class="abschlag sortable">
    <li>
        Item 1
    </li>
    <li>
        Item 2
    </li>
    <li>
        Item 3
    </li>
    <li>
        Item 4
        <ol class="milestone sortable">
            <li>Item 3.1</li>
            <li>Item 3.2</li>
            <li>Item 3.3</li>
            <li>Item 3.4</li>
            <li>Item 3.5</li>
            <li>Item 3.6</li>
        </ol>
    </li>
    <li>
        Item 5
    </li>
    <li>
        Item 6
    </li>
</ol>


<!--<ol class="sortable abschlag">-->
<!--    <li>-->
<!--        Abschlag 1-->
<!--        <ol class="sortable milestone"></ol>-->
<!--    </li>-->
<!--    <li>-->
<!--        Abschlag 2-->
<!--        <ol class="sortable milestone">-->
<!--            <li>1</li>-->
<!--            <li>2</li>-->
<!--        </ol>-->
<!--    </li>-->
<!--    <li>-->
<!--        Abschlag 3-->
<!--        <ol class="sortable milestone">-->
<!--            <li>3</li>-->
<!--            <li>4</li>-->
<!--            <li>5</li>-->
<!--        </ol>-->
<!--    </li>-->
<!--    <li>-->
<!--        Abschlag 4-->
<!--        <ol class="sortable milestone"></ol>-->
<!--    </li>-->
<!--    <li>-->
<!--        Abschlag 5-->
<!--        <ol class="sortable milestone"></ol>-->
<!--    </li>-->
<!--    <li>-->
<!--        Abschlag 6-->
<!--        <ol class="sortable milestone"></ol>-->
<!--    </li>-->
<!--</ol>-->

