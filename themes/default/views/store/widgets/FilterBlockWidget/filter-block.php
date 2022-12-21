<?php //$this->widget('application.modules.store.widgets.filters.CheckboxOneFilterWidget'); ?>

<?php $this->widget(
    'application.modules.store.widgets.filters.AttributesFilterWidget', [
        'attributes' => $attributes,
        'category' => $category,
    ]
) ?>

<?php if (!empty($attributes) || !empty($category)): ?>    
    <input type="submit" class="filter-apply" value="Применить">
<?php endif; ?>