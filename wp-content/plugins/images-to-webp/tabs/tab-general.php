<?php

function q_select( $field_data = array(), $print = 1, $cols = array( 'value' => 'ID', 'text' => 'post_title' ) ){
	if( ! is_object( $field_data ) ) $field_data = (object)$field_data;
	$field_data->value = is_array( $field_data->value ) ? $field_data->value : array( $field_data->value );
	$select = sprintf(
		'<select name="%s" id="%s" %s %s>',
		$field_data->name,
		$field_data->id,
		isset( $field_data->multiple ) ? 'multiple' : '',
		isset( $field_data->size ) ? 'size="' . $field_data->size . '"' : ''
	);
	if( isset( $field_data->placeholder ) ){
		$select .= '<option value="" disabled>' . $field_data->placeholder . '</option>';
	}
	foreach( $field_data->options as $option => $value ){
		if( isset( $value->ID ) || isset( $value->term_id ) ){
			$post_id = isset( $value->ID ) ? $value->ID : $value->term_id;
			$value = (array)$value;
			if( class_exists( 'PLL_Model' ) ){
				$post_lang = pll_get_post_language( $post_id );
				if( pll_default_language() != $post_lang ) continue;
			}
			$select .= sprintf(
				'<option value="%s" %s>%s</option>',
				$value[ $cols['text'] ],
				in_array( $value[ $cols['text'] ] , $field_data->value ) ? 'selected' : '',
				$value[ $cols['value'] ]
			);
		}else{
			$select .= sprintf(
				'<option value="%s" %s>%s</option>',
				$option,
				in_array( $option, $field_data->value ) ? 'selected' : '',
				$value
			);
		}
	}
	$select .= '</select>';
	if( $print )
		echo $select;
	else
		return $select;
}

if( isset( $_POST['plugin_sent'] ) ) echo '<div class="updated"><p>' . __('Settings saved.') . '</p></div>'; ?>

<form method="post" action="">
	<input type="hidden" name="plugin_sent" value="1">
	<table class="form-table">
		<tr>
			<th>
				<label for="q_field_1"><?php _e( 'Images quality', 'images-to-webp' ) ?></label> 
			</th>
			<td>
				<input type="number" min="1" max="100" step="1" name="webp_quality" placeholder="85" value="<?php echo $this->settings['webp_quality'] ?>" id="q_field_1"> %
			</td>
		</tr>
		<tr>
			<th>
				<label for="q_field_2"><?php _e( 'Convert images to WebP during upload', 'images-to-webp' ) ?></label> 
			</th>
			<td><?php
				q_select(array(
					'name' => 'upload_convert',
					'id' => 'q_field_2',
					'value' => $this->settings['upload_convert'],
					'options' => array(
						0 => __('No'),
						1 => __('Yes')
					)
				)); ?>
			</td>
		</tr>
		<tr>
			<th>
				<label for="q_field_3"><?php _e( 'Conversion method', 'images-to-webp' ) ?></label> 
			</th>
			<td><?php
				$methods = get_site_option('images_to_webp_methods');
				q_select(array(
					'name' => 'method',
					'id' => 'q_field_3',
					'value' => $this->settings['method'],
					'options' => $methods
				)); ?>
			</td>
		</tr>
		<tr>
			<th>
				<label><?php _e( 'Convert these image extensions to WebP:', 'images-to-webp' ) ?></label> 
			</th>
			<td>
				<?php $this->extensions = apply_filters( 'itw_extensions', $this->extensions ); ?>
				<?php foreach( $this->extensions as $extension ): ?>
					<br>
					<label>
						<input type="checkbox" name="extensions[]" value="<?php echo $extension ?>" <?php echo in_array( $extension, $this->settings['extensions'] ) ? 'checked="checked"' : '' ?>>
						.<?php echo $extension ?>
					</label>
				<?php endforeach ?>
			</td>
		</tr>
	</table>
	<p class="submit"><input type="submit" class="button button-primary button-large" value="<?php _e('Save') ?>"></p>
</form>