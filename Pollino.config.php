<?php



class PollinoConfig extends ModuleConfig{

    public function __construct(){

        $this->add(array(
            array(
                'name' => 'form_action',
                'type' => 'text',
                'label' => 'Default form action',
                'value' => './',
                'description' => 'Default action url for the voting form.',
            ),
            array(
                'name' => 'result_sorting',
                'type' => 'select',
                'label' => 'Default result sorting',
                'value' => 'sort',
                'description' => 'Default sorting of the answers.',
                'options' => array(
                    'sort' => 'Sort as in tree',
                    'vote_desc' => 'Sort by Votes DESC',
                    'vote_asc' => 'Sort by Voted ASC',
                )
            ),
            array(
            	'name' => 'show_expiry',
            	'type' => 'checkbox',
            	'label' => 'Show poll end date if set',
            	'checkboxLabel' => 'Show poll end date'
            ),
            array(
                'label' => 'HTML Templates',
                'type' => 'fieldset',
                'children' => array(
		            array(
		                'label' => 'Generic',
		                'type' => 'fieldset',
		                'description' => 'These templates apply both to the poll form and the result display',
		                'collapsed' => true,
		                'children' => array(
				            array(
				            	'name' => 'poll_tpl',
				            	'type' => 'textarea',
				            	'rows' => 6,
				            	'label' => 'Wrapper for poll (form and result)',
				            	'value' => '<div class="pollino_poll">' . "\n\t" .
									'<div class="pollino_inner">' . "\n\t\t" .
										'<h3>{title}</h3>' . "\n\t\t" .
										'{poll}' . "\n\t" .
									'</div>' . "\n" .
								'</div>',
				            ),
				            array(
				            	'name' => 'expiry_tpl',
				            	'type' => 'text',
				            	'label' => 'Wrapper for poll end date',
				            	'value' => '<p class="pollino_close">{label}<br>{closedate}</p>'
				            ),
				            array(
				                'name' => 'message_tpl',
				                'type' => 'text',
				                'label' => 'Wrapper for error messages',
				                'value' => '<p class="pollino_error">{message}</p>',
				            ),
				        ),
				    ),
		            array(
		                'label' => 'Poll Form',
		                'type' => 'fieldset',
		                'description' => 'Templates only used in the poll form',
		                'collapsed' => true,
		                'children' => array(
				            array(
				                'name' => 'form_tpl',
				                'type' => 'textarea',
				                'label' => 'Form template',
				                'rows' => 8,
				                'value' => '<form action="{form_action}" method="get" class="pollino_form">' . "\n\t" .
									'<input type="hidden" name="pollino_poll" value="{id}">' . "\n\t" .
									'{configField}' . "\n\t" .
									'{message}' . "\n\t" .
									'{list}' . "\n\t" .
									'{button} {loader}' . "\n\t" .
									'{closing}' . "\n" .
								'</form>',
				            ),
				            array(
				                'name' => 'answer_outertpl',
				                'type' => 'text',
				                'label' => 'Form choice list wrapper',
				                'value' => '<ul class="pollino_list">{out}</ul>',
				            ),
				            array(
				                'name' => 'form_rowtpl',
				                'type' => 'textarea',
				                'label' => 'Form row template',
				                'rows' => 4,
				                'value' => '<li class="pollino_item">' . "\n\t" .
				                	'<label><input type="radio" name="pollino_answer" value="{id}"> {title}</label>' . "\n" .
				                '</li>',
				            ),
				            array(
				                'name' => 'form_submittpl',
				                'type' => 'text',
				                'label' => 'Form submit button template',
				                'value' => '<input class="pollino_submit" type="submit" value="{value}">',
				            ),
				            array(
				                'name' => 'form_loadertpl',
				                'type' => 'text',
				                'label' => 'Form loading indicator',
				                'value' => '<span class="pollino_loader pollino_hidden"></span>',
				            ),
				        ),
				    ),
		            array(
		                'label' => 'Result Display',
		                'type' => 'fieldset',
		                'description' => 'Templates only for displaying results',
		                'collapsed' => true,
		                'children' => array(
				            array(
				                'name' => 'result_tpl',
				                'type' => 'textarea',
				                'label' => 'Result template',
				                'value' => '{message}' . "\n" . '{list}' . "\n" . '{closed}' . "\n" . '{total}',
				            ),
				            array(
				                'name' => 'result_outertpl',
				                'type' => 'text',
				                'label' => 'Result list wrapper',
				                'value' => '<ol class="pollino_list_results">{out}</ol>',
				            ),
				            array(
				                'name' => 'result_rowtpl',
				                'type' => 'textarea',
				                'label' => 'Result row template',
				                'rows' => 6,
				                'value' => '<li class="pollino_item pollino_item{key}">' . "\n\t" .
								    '<span class="pollino_percent_wrapper">' . "\n\t\t" .
								        '<span class="pollino_percent_bar stretchRight" style="width:{vote_percent}%;">&nbsp;</span>' . "\n\t" .
								    '</span>' . "\n\t" .
								    '{title} ({vote_percent}%, {vote_count})' . "\n" .
								'</li>',
				            ),
				            array(
				            	'name' => 'total_tpl',
				            	'type' => 'text',
				            	'label' => 'Total vote count template',
				            	'value' => '<p class="pollino_total">{label} {vote_total}</p>',
				            ),
				        ),
				    ),
		        ),
	        ),
            array(
                'name' => 'Prevent Multiple Votings',
                'type' => 'fieldset',
                'children' => array(
                    array(
                        'name' => 'prevent_voting_type',
                        'value' => 'use_cookie',
                        'label' => 'Prevent Multiple Votings Method',
                        'description' => 'Choose one or the other method',
                        'type' => 'radios',
                        'options' => array(
                            'use_cookie' => 'Cookie',
                            'use_ip' => "by IP",
                            'use_user' => "by User (registered)",
                            ),
                        'columnWidth' => 100,
                        'optionColumns' => 5
                    ),
                    // cookies
                    array(
                        'name' => 'cookie_expires',
                        'value' => 86400,
                        'label' => 'Cookie Lifetime',
                        'description' => 'Lifetime of the cookie in seconds',
                        'notes' => '86400 = day, 3600 = hour',
                        'type' => 'integer',
                        'columnWidth' => 50,
                        'showIf' => 'prevent_voting_type=use_cookie',
                    ),
                    array(
                        'name' => 'cookie_prefix',
                        'value' => 'pillono_',
                        'label' => 'Cookie Prefix',
                        'description' => 'Prefix used for the client side cookies',
                        'type' => 'text',
                        'columnWidth' => 50,
                        'showIf' => 'prevent_voting_type=use_cookie',
                    ),
                    // IP
                    array(
                        'name' => 'ip_expires',
                        'value' => 86400,
                        'label' => 'IP Lifetime',
                        'description' => 'Seconds after the IP restriction will expire. Enter 0 to no expire.',
                        'notes' => '86400 = day, 3600 = hour, 0 = never expire',
                        'type' => 'integer',
                        'columnWidth' => 50,
                        'showIf' => 'prevent_voting_type=use_ip',
                    ),
                    array(
                        'name' => 'use_ua',
                        'value' => 0,
                        'label' => 'UserAgent',
                        'description' => 'Additionally use the User Agent string',
                        'type' => 'checkbox',
                        'columnWidth' => 50,
                        'showIf' => 'prevent_voting_type=use_ip',
                    ),
                    // user
                    array(
                        'name' => 'user_info',
                        'value' => "By using this option. The logged in user will be used to prevent multiple votings. The rest is up to you to handle where and how to render your polls.",
                        'label' => 'User restriction',
                        'type' => 'markup',
                        'showIf' => 'prevent_voting_type=use_user',
                    ),
                ),
            ),

        ));
    }

}