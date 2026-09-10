<?php echo $__env->make('wayfinder::docblock', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo when($shouldExport, 'export '); ?>const <?php echo $method; ?> = (<?php echo $__env->make('wayfinder::function-arguments', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>): RouteDefinition<<?php echo \Illuminate\Support\Js::from($verbs->first()->actual)->toHtml() ?>> => ({
    url: <?php echo $method; ?>.url(<?php echo when($parameters->isNotEmpty(), $args . ', '); ?><?php echo $options; ?>),
    method: <?php echo \Illuminate\Support\Js::from($verbs->first()->actual)->toHtml() ?>,
})

<?php echo $method; ?>.definition = {
    methods: <?php echo $verbs->pluck('actual')->toJson(); ?>,
    url: <?php echo $uri; ?>,
} satisfies RouteDefinition<<?php echo $verbs->pluck('actual')->toJson(); ?>>

<?php echo $__env->make('wayfinder::docblock', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $method; ?>.url = (<?php echo $__env->make('wayfinder::function-arguments', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>) => {
<?php if($parameters->count() === 1): ?>
    if (typeof <?php echo $args; ?> === 'string' || typeof <?php echo $args; ?> === 'number') {
        <?php echo $args; ?> = { <?php echo $parameters->first()->name; ?>: <?php echo $args; ?> }
    }

    <?php if($parameters->first()->key): ?>
        if (typeof <?php echo $args; ?> === 'object' && !Array.isArray(<?php echo $args; ?>) && <?php echo \Illuminate\Support\Js::from($parameters->first()->key)->toHtml() ?> in <?php echo $args; ?>) {
            <?php echo $args; ?> = { <?php echo $parameters->first()->name; ?>: <?php echo $args; ?>.<?php echo $parameters->first()->key; ?> }
        }
    <?php endif; ?>
<?php endif; ?>

<?php if($parameters->isNotEmpty()): ?>
    if (Array.isArray(<?php echo $args; ?>)) {
        <?php echo $args; ?> = {
        <?php $__currentLoopData = $parameters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parameter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $parameter->name; ?>: <?php echo $args; ?>[<?php echo $loop->index; ?>],
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        }
    }

    <?php echo $args; ?> = applyUrlDefaults(<?php echo $args; ?>)
<?php endif; ?>

<?php if($parameters->where('optional')->isNotEmpty()): ?>
    validateParameters(<?php echo $args; ?>, [
    <?php $__currentLoopData = $parameters->where('optional'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parameter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        "<?php echo $parameter->name; ?>",
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    ])
<?php endif; ?>

<?php if($parameters->isNotEmpty()): ?>
    const <?php echo $parsedArgs; ?> = {
    <?php $__currentLoopData = $parameters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parameter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($parameter->key): ?>
            <?php echo $parameter->name; ?>: <?php echo when($parameter->default !== null, '('); ?>typeof <?php echo $args; ?><?php echo when($parameters->every->optional, '?'); ?>.<?php echo $parameter->name; ?> === 'object'
                ? <?php echo $args; ?>.<?php echo $parameter->name; ?>.<?php echo $parameter->key ?? 'id'; ?>

                : <?php echo $args; ?><?php echo when($parameters->every->optional, '?'); ?>.<?php echo $parameter->name; ?><?php echo when($parameter->default !== null, ') ?? '); ?><?php if($parameter->default !== null): ?><?php echo \Illuminate\Support\Js::from($parameter->default)->toHtml() ?><?php endif; ?>,
        <?php else: ?>
            <?php echo $parameter->name; ?>: <?php echo $args; ?><?php echo when($parameters->every->optional, '?'); ?>.<?php echo $parameter->name; ?><?php echo when($parameter->default !== null, ' ?? '); ?><?php if($parameter->default !== null): ?><?php echo \Illuminate\Support\Js::from($parameter->default)->toHtml() ?><?php endif; ?>,
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    }
<?php endif; ?>

    return <?php echo $method; ?>.definition.url
<?php $__currentLoopData = $parameters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parameter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            .replace(<?php echo \Illuminate\Support\Js::from($parameter->placeholder)->toHtml() ?>, <?php echo $parsedArgs; ?>.<?php echo $parameter->name; ?><?php echo when($parameter->optional, '?'); ?>.toString()<?php echo when($parameter->optional, " ?? ''"); ?>)
    <?php if($loop->last): ?>
            .replace(/\/+$/, '')
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> + queryParams(<?php echo $options; ?>)
}

<?php $__currentLoopData = $verbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $verb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php echo $__env->make('wayfinder::docblock', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $method; ?>.<?php echo $verb->actual; ?> = (<?php echo $__env->make('wayfinder::function-arguments', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>): RouteDefinition<<?php echo \Illuminate\Support\Js::from($verb->actual)->toHtml() ?>> => ({
    url: <?php echo $method; ?>.url(<?php echo when($parameters->isNotEmpty(), $args . ', '); ?><?php echo $options; ?>),
    method: <?php echo \Illuminate\Support\Js::from($verb->actual)->toHtml() ?>,
})
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php if($withForm): ?>
    <?php echo $__env->make('wayfinder::docblock', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    const <?php echo $method; ?>Form = (<?php echo $__env->make('wayfinder::function-arguments', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>): RouteFormDefinition<<?php echo \Illuminate\Support\Js::from($verbs->first()->formSafe)->toHtml() ?>> => ({
        action: <?php echo $method; ?>.url(
            <?php echo when($parameters->isNotEmpty(), $args . ', '); ?>

            <?php if($verbs->first()->formSafe === $verbs->first()->actual): ?>
                <?php echo $options; ?>

            <?php else: ?>
                {
                    [<?php echo $options; ?>?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: <?php echo \Illuminate\Support\Js::from(strtoupper($verbs->first()->actual))->toHtml() ?>,
                        ...(<?php echo $options; ?>?.query ?? <?php echo $options; ?>?.mergeQuery ?? {}),
                    }
                }
            <?php endif; ?>
        ),
        method: <?php echo \Illuminate\Support\Js::from($verbs->first()->formSafe)->toHtml() ?>,
    })

    <?php $__currentLoopData = $verbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $verb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo $__env->make('wayfinder::docblock', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $method; ?>Form.<?php echo $verb->actual; ?> = (<?php echo $__env->make('wayfinder::function-arguments', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>): RouteFormDefinition<<?php echo \Illuminate\Support\Js::from($verb->formSafe)->toHtml() ?>> => ({
            action: <?php echo $method; ?>.url(
                <?php echo when($parameters->isNotEmpty(), $args . ', '); ?>

                <?php if($verb->formSafe === $verb->actual): ?>
                <?php echo $options; ?>

                <?php else: ?>
                    {
                        [<?php echo $options; ?>?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: <?php echo \Illuminate\Support\Js::from(strtoupper($verb->actual))->toHtml() ?>,
                            ...(<?php echo $options; ?>?.query ?? <?php echo $options; ?>?.mergeQuery ?? {}),
                        }
                    }
                <?php endif; ?>
            ),
            method: <?php echo \Illuminate\Support\Js::from($verb->formSafe)->toHtml() ?>,
        })
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php echo $method; ?>.form = <?php echo $method; ?>Form
<?php endif; ?>
<?php /**PATH /private/tmp/claude-502/-Users-tanaydinsirin-Desktop-personal-bp/e068d5c9-c1df-4edf-82ee-3a7deef9933e/scratchpad/laravel-new/vendor/laravel/wayfinder/src/../resources/method.blade.ts ENDPATH**/ ?>