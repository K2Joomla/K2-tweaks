<?php defined('_JEXEC') or die;

/**
 * File       k2interfacetweaks.php
 * Created    9/19/14 1:52 PM
 * Author     Matt Thomas | matt@betweenbrain.com | http://betweenbrain.com
 * Support    https://github.com/betweenbrain/
 * Copyright  Copyright (C) 2014 betweenbrain llc. All Rights Reserved.
 * License    GNU GPL v2 or later
 */
class plgSystemK2interfacetweaks extends JPlugin
{

	/**
	 * Constructor.
	 *
	 * @param   object &$subject The object to observe
	 * @param   array  $config   An optional associative array of configuration settings.
	 *
	 * @since   0.1
	 */
	public function __construct(&$subject, $config)
	{
		parent::__construct($subject, $config);

		$this->app     = JFactory::getApplication();
		$this->session = JFactory::getSession();
	}

	/**
	 * Event is triggered after the framework has rendered the application.
	 *
	 * @return bool
	 */
	function onAfterRender()
	{

		if ($this->app->isAdmin() && JFactory::getApplication()->input->getCmd('option') == 'com_k2')
		{
			$buffer = JFactory::getApplication()->getBody();

			switch (JFactory::getApplication()->input->getCmd('view'))
			{
				case('item') :

					// Hide Image Tab and Content
					$patterns[] = '/<li\b[^>]*id=\"tabImage\"[^>]*>(.*?)<\/li>/i';
					$patterns[] = '/<!-- Tab image -->[^!]*(.*?)<\/div>/i';

					// Hide Image Gallery Tab and Content
					$patterns[] = '/<li\b[^>]*id=\"tabImageGallery\"[^>]*>(.*?)<\/li>/i';
					$patterns[] = '/<!-- Tab image gallery -->[^!]*(.*?)<\/div>/i';

					// Hide Attachments Tab and Content
					$patterns[] = '/<li\b[^>]*id=\"tabAttachments\"[^>]*>(.*?)<\/li>/i';
					$patterns[] = '/<!-- Tab attachements -->[^!]*(.*?)<\/div>/i';

					foreach ($patterns as $pattern)
					{
						$buffer = preg_replace($pattern, '', $buffer);
					}

					JFactory::getApplication()->setBody($buffer);
					break;
			}

		}

		return true;
	}
}
