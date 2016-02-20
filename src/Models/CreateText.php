<?php

namespace Zivsluck\Models;

/**
 * Zivsluck-CreateText
 *
 * Create a necklace with a selected font
 *
 * @link http://zbase.dennesabing.com
 * @author Dennes B Abing <dennes.b.abing@gmail.com>
 * @license proprietary
 * @copyright Copyright (c) 2016 ClaremontDesign/MadLabs-Dx
 * @file CreateText.php
 * @project Zivsluck
 * @package Zivsluck/Model
 */
class CreateText
{

	/**
	 * The default font
	 */
	const DEFAULT_FONT = 'deftone';

	/**
	 * Map of Fonts
	 * @var array
	 */
	protected $fontMaps = null;

	/**
	 * The Selected font
	 * @var string
	 */
	protected $font = null;

	/**
	 * The Text to be created
	 * @var string
	 */
	protected $text = null;

	/**
	 * order Data
	 * @var \Zivsluck\Entity\Order
	 */
	protected $orderData = null;

	/**
	 * The Image
	 * @var
	 */
	protected $_image = null;

	public function __construct()
	{
		$this->fontMaps = zbase_config_get('zivsluck.fontmaps');
	}

	public function create($text, $font = null, $material = null, $options = null)
	{
		if(!empty($text))
		{
			$this->setText($text);
		}
		if(!empty($font))
		{
			$this->setFont($font);
		}
		if(!$this->orderData instanceof \Zivsluck\Entity\Laravel\Order && !empty($options['oid']))
		{
			$orderData = zbase_entity('custom_orders')->repository()->byId($options['oid']);
			if(empty($orderData))
			{
				return zbase_abort(404);
			}
			$this->setOrderData($orderData);
		}
		$tags = [];
		$dealerCopy = !empty($options['dealerCopy']) ? true : false;
		/**
		 * <span id="IL_AD8" class="IL_AD">Setup</span> some custom variables for creating our font and image.
		 */
		$chain = !empty($options['chain']) ? $options['chain'] : false;
		$chainLength = !empty($options['chainLength']) ? $options['chainLength'] : false;
		$maxLetter = 7;
		$pricePerLetter = 20;
		$boxWidth = 280;
		$boxHeight = 200;
		$brandingHeightPosition = 200;
		$borderWidth = 10;
		$hasBorder = !empty($dealerCopy) ? true : false;
		$hasDetails = false;
		$fontsNotForMaterial = zbase_config_get('zivsluck.chains.' . $material . '.fonts.not', []);
		$fontNotForMaterial = false;
		$posYDiff = 0;
		if(!empty($fontsNotForMaterial))
		{
			if(in_array($font, $fontsNotForMaterial))
			{
				$fontNotForMaterial = true;
			}
		}
		if(!empty($chain) && !empty($chainLength))
		{
			$hasDetails = true;
			$boxWidth = 280;
			$boxHeight = 600;
			$brandingHeightPosition = 600;
			$chainFile = zbase_config_get('zivsluck.chains.' . strtolower($material) . '.' . strtolower($chain) . '.file', false);
			$chainImage = zbase_public_path() . '/zbase/assets/zivsluck/img/chain/' . $chainFile;
			$tags[] = $chain;
		}

		$letterPrice = 0;
		$shippingFee = 0;
		$hasShipping = false;
		$total = 0;
		$courier = !empty($options['courier']) ? $options['courier'] : false;
		if(!empty($courier))
		{
			$courier = zbase_config_get('zivsluck.shipping.' . strtolower($courier), false);
			if(!empty($courier))
			{
				$deliveryMode = !empty($options['deliveryMode']) ? $options['deliveryMode'] : false;
				$hasShipping = true;
				$courierName = $courier['name'];
				if($deliveryMode == 'meetup')
				{
					$courierText = 'Meet Up';
					$shippingFee = 0.00;
				}
				else
				{
					$shippingFee = $courier['fee'];
					$courierText = $courierName . ' - ' . ($deliveryMode == 'doortodoor' ? 'Door-to-Door' : 'PickUp');
				}

				$boxWidth = 280;
				$boxHeight = 800;
				$brandingHeightPosition = 800;
			}
			if(empty($options['shippingSame']))
			{
				$options['shippingFirstName'] = $options['first_name'];
				$options['shippingLastName'] = $options['last_name'];
			}
		}
		$customerNote = !empty($options['customerNote']) ? $options['customerNote'] : '';

		$orderData = $this->getOrderData();
		$statusNew = false;
		$statusPaid = false;
		if(!empty($orderData))
		{
			$statusPaid = $orderData->status == 2;
			if(!empty($options['download']) && $orderData->status == 1)
			{
				$boxWidth = 280;
				$boxHeight = 800 + 380;
				$posYDiff = 190;
				$brandingHeightPosition = 800;
				$statusNew = true;
			}
			if(!empty($statusPaid))
			{
				$paymentCenterName = zbase_config_get('zivsluck.paymentCenters.' . $orderData->payment_merchant . '.shortName');
				$paymentAmount = $orderData->total;
				if(file_exists(zbase_storage_path() . '/zivsluck/order/receipts/' . $orderData->maskedId() . '.png'))
				{
					$paymentDetailsIm = imagecreatefrompng(zbase_storage_path() . '/zivsluck/order/receipts/' . $orderData->maskedId() . '.png');
					$boxHeight = $boxHeight + imagesy($paymentDetailsIm);
					$posYDiff = imagesy($paymentDetailsIm) / 2;
					$brandingHeightPosition = 800;
				}
			}
		}

		$price = zbase_config_get('zivsluck.price.' . $material, false);

		$fontSize = 30; // font size
		$chars = 30;
		$fontFile = zbase_public_path() . '/zbase/assets/zivsluck/fonts/deftonestylus.ttf'; // the text file to be used
		$verdanaFont = zbase_public_path() . '/zbase/assets/zivsluck/fonts/verdana.ttf'; // the text file to be used
		$textureFile = zivsluck()->path() . 'resources/assets/img/texture/' . strtolower($material) . '.png'; // the texture file
		$logo = zivsluck()->path() . 'resources/assets/img/texture/logo.png'; // the texture file
		$paymentDetails = zivsluck()->path() . 'resources/assets/img/payments/bayadCenter.png'; // the texture file
		$fontDetails = $this->getFontDetails();
		$tags[] = $material;
		$tags[] = $font;

		if(!empty($dealerCopy))
		{
			$boxWidth = 280;
			$boxHeight = 500;
			$brandingHeightPosition = 500;
			$posYDiff = 0;
		}

		/**
		 * Get text string that is <span id="IL_AD7" class="IL_AD">passed</span> to this file and clean it up.
		 */
		$text = $this->getText();
		$text = trim(strip_tags(html_entity_decode($text)));
		$text = trim(preg_replace('/ss+/', ' ', $text));
		$text = ( strlen($text) > $chars ) ? substr($text, 0, $chars) . '..' : $text;

		if(!empty($fontDetails['enable']))
		{
			$fontFile = zbase_public_path() . '/zbase/assets/zivsluck/fonts/' . $fontDetails['file'];
			if(!empty($fontDetails['fontsize']))
			{
				$fontSize = $fontDetails['fontsize'];
			}
		}
		else
		{
			$fontFile = $verdanaFont;
			$text = 'FONT NOT AVAILABLE.';
		}
		if($fontNotForMaterial)
		{
			$fontFile = $verdanaFont;
			$fontSize = 14; // font size
			$text = wordwrap("ERROR: \nFONT NOT FOR " . strtoupper($material) . ". \nSelect another font.", 20);
			$hasDetails = false;
			$boxWidth = 280;
			$boxHeight = 200;
			$brandingHeightPosition = 200;
		}

		// <editor-fold defaultstate="collapsed" desc="Image Printin">
		/**
		 * Read the TTF file and get the width and height of our font.
		 */
		$box = imagettfbbox($fontSize, 0, $fontFile, $text);
		$width = abs($box[2] - $box[0]) + 50;
		/**
		 * Create <span id="IL_AD2" class="IL_AD">the blank</span> image, alpha channel and colors.
		 */
		// http://stackoverflow.com/questions/26288347/php-gd-complex-stacking-multiple-layers
		// $clipart = imagecreatefrompng(zivsluck()->path() . 'resources/assets/img/createBaseImage.png');
		$bgTexture = imagecreatefrompng($textureFile);
		$logo = imagecreatefrompng($logo);
		$white = imagecolorallocate($bgTexture, 255, 255, 255);
		if($dealerCopy)
		{
			// Canvass
			$bgTexture = imagecreatetruecolor($boxWidth - ($borderWidth * 2), $boxHeight - ($borderWidth * 2));
			// Background Color
			$white = imagecolorallocate($bgTexture, 255, 255, 255);
		}
		/**
		 * Create text on a white background
		 */
		imagefill($bgTexture, 0, 0, $white);
		$textColorBlack = imagecolorallocate($bgTexture, 0, 0, 0);

		if(empty($posY))
		{
			if($hasDetails)
			{
				if($hasShipping)
				{
					$posY = ($boxHeight / 2) + 10 - 300 - $posYDiff;
				}
				else
				{
					$posY = ($boxHeight / 2) + 10 - 200 - $posYDiff;
				}
			}
			else
			{
				$posY = ($boxHeight / 2) + 10 - $posYDiff;
			}
			$posX = ($boxWidth / 2) - ($width / 2) + 10;
			if(!empty($hasBorder))
			{
				$posY = ($boxHeight / 2) + 10 - 150 - $borderWidth - $posYDiff;
				$posX = ($boxWidth / 2) - ($width / 2);
			}
		}
		if($fontNotForMaterial)
		{
			imagettftext($bgTexture, $fontSize, 0, $posX, 60, $textColorBlack, $fontFile, $text);
		}
		else
		{
			imagettftext($bgTexture, $fontSize, 0, $posX, $posY, $textColorBlack, $fontFile, $text);
		}

		$im = imagecreatetruecolor($boxWidth, $boxHeight);
		if(!empty($dealerCopy))
		{

			imagecopy($im, $bgTexture, $borderWidth, $borderWidth, 0, 0, $boxWidth, $boxHeight);
		}
		else
		{
			imagecopy($im, $bgTexture, 0, 0, 0, 0, $boxWidth, $boxHeight);
		}
		$img = imagecreatetruecolor($boxWidth, $boxHeight);
		imagecopymerge($img, $im, 0, 0, 0, 0, $boxWidth, $boxHeight, 100);
		if($hasBorder)
		{
			imagecopy($img, $logo, 234, $brandingHeightPosition - 45, 0, 0, imagesx($logo), imagesy($logo));
		}
		else
		{
			imagecopy($img, $logo, 245, $brandingHeightPosition - 35, 0, 0, $boxWidth, $boxHeight);
		}

		if(!empty($dealerCopy))
		{
			// Add border
			imagefilltoborder($img, 1, 1, $textColorBlack, $white);
		}
		// </editor-fold>
		// <editor-fold defaultstate="collapsed" desc="ADDON">
		$totalAddon = 0;
		if(!empty($options['addon']))
		{
			$addonDroppableTop = zbase_config_get('zivsluck.addons.configuration.droppable.top') - 5;
			$addonDroppableLeft = zbase_config_get('zivsluck.addons.configuration.droppable.left') - 5;
			$addonDroppableHeight = zbase_config_get('zivsluck.addons.configuration.droppable.height');
			$addonDroppableWidth = zbase_config_get('zivsluck.addons.configuration.droppable.width');
			$addons = explode('|', $options['addon']);
			$includedAddons = [];
			foreach ($addons as $addon)
			{
				if(!empty($addon))
				{
					$addon = explode('-', $addon);
					$addonName = !empty($addon[0]) ? $addon[0] : false;
					$addonEnabled = zbase_config_get('zivsluck.addons.' . $addonName . '.enable');
					$addonFile = zivsluck()->path() . 'resources/assets/img/addons/' . zbase_config_get('zivsluck.addons.' . $addonName . '.file');
					$addonPosition = !empty($addon[1]) ? explode(',', $addon[1]) : false;
					$addonSize = !empty($addon[2]) ? explode('x', $addon[2]) : false;
					$addonRotate = intval(!empty($addon[3]) ? $addon[3] : false);
					if(!empty($addonEnabled) && file_exists($addonFile))
					{
						if(!in_array($addonName, $tags))
						{
							$tags[] = $addonName;
						}
						$includedAddons[] = $addonName;
						$addonNewImage = imagecreatetruecolor($addonSize[0], $addonSize[1]);
						$transparent = imagecolorallocatealpha($addonNewImage, 0, 0, 0, 127);
						$addonFile = imagecreatefrompng($addonFile);
						if(!empty($addonRotate))
						{
							$addonFile = imagerotate($addonFile, 360 - $addonRotate, imageColorAllocateAlpha($addonFile, 0, 0, 0, 127));
						}
						if(empty($addonSize[0]))
						{
							$addonSize[0] = imagesx($addonFile);
						}
						if(empty($addonSize[1]))
						{
							$addonSize[1] = imagesy($addonFile);
						}
						imagefill($addonNewImage, 0, 0, $transparent);
						imagecopyresampled($addonNewImage, $addonFile, 0, 0, 0, 0, $addonSize[0], $addonSize[1], imagesx($addonFile), imagesy($addonFile));
						$totalAddon++;
						imagecopy($img, $addonNewImage, $addonPosition[0] + $addonDroppableLeft, $addonPosition[1] + $addonDroppableTop, 0, 0, $addonSize[0], $addonSize[1]);
					}
				}
			}
		}
		// </editor-fold>
		// <editor-fold defaultstate="collapsed" desc="Checkout Details">
		if($hasDetails)
		{
			// <editor-fold defaultstate="collapsed" desc="DISCOUNT">
			$discountInPrice = zbase_config_get('zivsluck.promotion.discount', 0.00);
			if(!empty($orderData) && !empty($options['final']))
			{
				$promo = !empty($options['promo_flag']) ? true : false;
				if(!empty($promo))
				{
					$discountInPrice = $options['promo_discountprice'];
					$shippingFee = $options['promo_shipping_fee'];
					$associateOrderId = $options['promo_associate_order_id'];
				}
				else
				{
					if(!empty($options['promo_associate_order_id']))
					{
						$associateOrderId = $options['promo_associate_order_id'];
					}
				}
			}
			else
			{
				$promo = $this->_discountOnNextOrder($text, $font, $material, $options);
				$options['promo_flag'] = 0;
				if(!empty($promo))
				{
					$promoOrder = $promo;
					$promo = true;
					$options['promo_flag'] = 1;
					$shippingFee = 0.00;
					$options['promo_discountprice'] = $discountInPrice;
					$options['promo_shipping_fee'] = $shippingFee;
					$options['promo_associate_order_id'] = $promoOrder->id();
					$associateOrderId = $promoOrder->id();
				}
			}
			// </editor-fold>

			if(empty($dealerCopy))
			{
				$chainImage = imagecreatefrompng($chainImage);
				$total = $price;
				$subTotal = $price;
				$letterCount = strlen($text);
				$addonPrice = 0;
				$totalCharacters = ($letterCount + $totalAddon);
				if($totalCharacters > $maxLetter)
				{
					if($letterCount > $maxLetter)
					{
						if(!empty($totalAddon))
						{
							$addonCount = ($letterCount + $totalAddon) - $maxLetter;
							$addonPrice = $addonCount * 20;
							$total += $addonPrice;
							$subTotal += $addonPrice;
						}
					} else {
						$totalAddon = $totalCharacters - $maxLetter;
						$addonPrice = $totalAddon * 20;
					}
				}
//				if($letterCount < $maxLetter)
//				{
//					if(!empty($totalAddon))
//					{
//						$addonCount = ($letterCount + $totalAddon) - $maxLetter;
//						$addonPrice = $addonCount * 20;
//						$total += $addonPrice;
//						$subTotal += $addonPrice;
//					}
//				}
//				if($letterCount > $maxLetter)
//				{
//					$letterPrice = ($letterCount - $maxLetter) * 20;
//					$total += $letterPrice;
//					$addonPrice = $totalAddon * 20;
//					$total += $addonPrice;
//					$subTotal += $addonPrice;
//				}
				$total += $shippingFee;
				if(!empty($promo))
				{
					$total -= $discountInPrice;
				}
				if(!empty($orderData))
				{
					imagettftext($img, 12, 0, 15, 180, $textColorBlack, $verdanaFont, 'ORDER ID: ' . $orderData->maskedId());
				}
				imagecopy($img, $chainImage, 15, 295, 0, 0, imagesx($chainImage), imagesy($chainImage));
			}

			if(!empty($dealerCopy))
			{
				imagettftext($img, 9, 0, 25, 200, $textColorBlack, $verdanaFont, 'Text: ' . $text);
				imagettftext($img, 9, 0, 25, 220, $textColorBlack, $verdanaFont, 'Font: ' . $fontDetails['name']);
				imagettftext($img, 9, 0, 25, 240, $textColorBlack, $verdanaFont, 'Material: ' . ucfirst($material));
				imagettftext($img, 9, 0, 25, 260, $textColorBlack, $verdanaFont, 'Chain: ' . strtoupper($chain));
				imagettftext($img, 9, 0, 25, 280, $textColorBlack, $verdanaFont, 'Chain Length: ' . $chainLength . '"');
				if(!empty($includedAddons))
				{
					imagettftext($img, 8, 0, 25, 300, $textColorBlack, $verdanaFont, 'Included Addons:');
					imagettftext($img, 8, 0, 25, 320, $textColorBlack, $verdanaFont, wordwrap(implode(', ', $includedAddons),30));
				}
				if(!empty($customerNote))
				{
					imagettftext($img, 9, 0, 25, 360, $textColorBlack, $verdanaFont, 'Customer Note:');
					imagettftext($img, 8, 0, 25, 380, $textColorBlack, $verdanaFont, wordwrap($customerNote, 40));
				}
			}
			else
			{
				imagettftext($img, 9, 0, 15, 200, $textColorBlack, $verdanaFont, 'Text: ' . $text);
				imagettftext($img, 9, 0, 15, 215, $textColorBlack, $verdanaFont, 'Font: ' . $fontDetails['name']);
				imagettftext($img, 9, 0, 15, 230, $textColorBlack, $verdanaFont, 'Character: ' . strlen($text));
				imagettftext($img, 9, 0, 15, 245, $textColorBlack, $verdanaFont, 'Symbols: ' . $totalAddon);
				imagettftext($img, 9, 0, 15, 260, $textColorBlack, $verdanaFont, 'Material: ' . ucfirst($material));
				imagettftext($img, 9, 0, 15, 275, $textColorBlack, $verdanaFont, 'Chain Length: ' . $chainLength . '"');
				imagettftext($img, 9, 0, 15, 290, $textColorBlack, $verdanaFont, 'Chain: ' . strtoupper($chain));

				imagettftext($img, 9, 0, 15, 430, $textColorBlack, $verdanaFont, ucfirst($material) . ' Price: Php ' . number_format($price, 2));
				imagettftext($img, 9, 0, 15, 445, $textColorBlack, $verdanaFont, 'Characters: Php ' . number_format($letterPrice, 2));
				imagettftext($img, 9, 0, 15, 460, $textColorBlack, $verdanaFont, 'Symbols: Php ' . number_format($addonPrice, 2));
				if($hasShipping)
				{
					imagettftext($img, 9, 0, 15, 475, $textColorBlack, $verdanaFont, 'Shipping: Php ' . number_format($shippingFee, 2));
					imagettftext($img, 9, 0, 15, 490, $textColorBlack, $verdanaFont, 'Courier: ' . $courierText);
					if(!empty($promo))
					{
						imagettftext($img, 9, 0, 15, 505, $textColorBlack, $verdanaFont, 'Discount: ' . number_format($discountInPrice, 2) . ' (Order#' . $associateOrderId . ')');
					}
					else
					{
						if(!empty($associateOrderId))
						{
							imagettftext($img, 9, 0, 15, 505, $textColorBlack, $verdanaFont, 'Associate Order Id: ' . $associateOrderId);
						}
					}
					imagettftext($img, 9, 0, 15, 580, $textColorBlack, $verdanaFont, 'Shipping Information:');
					imagettftext($img, 9, 0, 15, 600, $textColorBlack, $verdanaFont, $options['shippingFirstName'] . ' ' . $options['shippingLastName']);
					imagettftext($img, 9, 0, 15, 615, $textColorBlack, $verdanaFont, $options['address']);
					imagettftext($img, 9, 0, 15, 630, $textColorBlack, $verdanaFont, $options['addressb']);
					imagettftext($img, 9, 0, 15, 645, $textColorBlack, $verdanaFont, $options['city']);
					imagettftext($img, 8, 0, 15, 665, $textColorBlack, $verdanaFont, 'Ordered By: ' . $options['first_name'] . ' ' . $options['last_name']);
					imagettftext($img, 8, 0, 15, 680, $textColorBlack, $verdanaFont, $options['fb']);
					imagettftext($img, 8, 0, 15, 695, $textColorBlack, $verdanaFont, 'Phone: ' . $options['phone']);
					if(!empty($options['email']))
					{
						imagettftext($img, 8, 0, 15, 710, $textColorBlack, $verdanaFont, 'Email: ' . $options['email']);
					}
					if(!empty($options['oid']))
					{
						imagettftext($img, 8, 0, 15, 748, $textColorBlack, $verdanaFont, 'Order Link: ' . zbase_url_create('order', array('id' => $options['oid'])));
					}
					imagettftext($img, 8, 0, 15, 760, $textColorBlack, $verdanaFont, 'Date: ' . date('F d, Y h:i A'));
				}
				imagettftext($img, 18, 0, 15, 540, $textColorBlack, $verdanaFont, 'Total: Php ' . number_format($total, 2));
				if(!empty($statusPaid))
				{
					imagettftext($img, 9, 0, 15, 555, $textColorBlack, $verdanaFont, 'PAID ' . number_format($paymentAmount, 2) . ' via ' . $paymentCenterName . ' (' . $orderData->paid_date_at->format('m/d/Y') . ')');
				}
				if(!empty($orderData) && $orderData->status == 1 && !empty($options['step']) && $options['step'] == 5)
				{
					$orderData->total = $total;
					$orderData->subtotal = $subTotal;
					$orderData->shipping_fee = $shippingFee;
					unset($options['step']);
					$options['final'] = 1;
					if(!empty($promoOrder))
					{
						$orderData->promo_flag = 1;
					}
					$orderData->details = json_encode($options);
					if(!empty($tags))
					{
						$orderData->tags = implode(', ', $tags);
					}
					$orderData->save();
					if(!empty($promoOrder))
					{
						$promoOrderDetails = (array) $promoOrder->details();
						$promoOrderDetails['promo_associate_order_id'] = $orderData->id();
						$promoOrder->details = json_encode($promoOrderDetails);
						$promoOrder->promo_flag = 1;
						$promoOrder->save();
					}
				}
			}
		}
		else
		{
			imagettftext($img, 9, 0, 15, 23, $textColorBlack, $verdanaFont, 'Font: ' . $fontDetails['name']);
		}
		if(!empty($hasBorder))
		{
			imagettftext($img, 7, 0, 15, $brandingHeightPosition - (10 + $borderWidth), $textColorBlack, $verdanaFont, 'Create your necklace at http://zivsluck.com');
		}
		else
		{
			imagettftext($img, 7, 0, 15, $brandingHeightPosition - 10, $textColorBlack, $verdanaFont, 'Create your necklace at http://zivsluck.com');
		}

		if(!empty($statusNew))
		{
			$paymentDetailsIm = imagecreatefrompng($paymentDetails);
			imagecopy($img, $paymentDetailsIm, 0, 800, 0, 0, $boxWidth, $boxHeight);
		}
		if(!empty($statusPaid) && empty($dealerCopy))
		{
			if(!empty($paymentDetailsIm))
			{
				imagecopy($img, $paymentDetailsIm, 0, 800, 0, 0, $boxWidth, $boxHeight);
			}
		}
		// </editor-fold>

		/**
		 * Label
		 */
		$this->_image = $img;
		return $this;
	}

	/**
	 * Php 100.00 discount on next order
	 * Mechanics for discount to be valid:
	 *  Next order should be of the same material as the first order.
	 *  First Name and Last Name should be the same from the first order.
	 *  Next order should be delivered on the same address as the first order.
	 *  Next order should be done within the day or in the next 24 hours since the first order was made.
	 *  Discount can only be used on the next order.
	 *  Discount will be reflected on the Order Confirmation page.
	 *
	 * @param string $text
	 * @param string $font
	 * @param string $material
	 * @param array $options
	 * @return boolean
	 */
	protected function _discountOnNextOrder($text, $font, $material, $options)
	{
		$enable = zivsluck_promotion();
		if(empty($enable))
		{
			return false;
		}
		if(!empty($options['first_name']) && !empty($options['last_name']))
		{
			$ownerName = $options['first_name'] . ' ' . $options['last_name'];
			$shippingAddress = $options['address'] . ' ' . $options['addressb'] . ', ' . $options['city'];
			$filters = ['name' => $ownerName, 'material' => $material, 'promo_flag' => 0];
			if(!empty($options['oid']))
			{
				// $filters['order_id'] = ['ne' => ['field' => 'order_id','value' => $options['oid']]];
			}
			$orderEntity = zbase_entity('custom_orders')->repository()->setDebug(false)->all(['*'], $filters, ['order_id' => 'asc']);
			if(!empty($orderEntity->count()))
			{
				$orderEntity = $orderEntity->first();
				if(!empty($options['oid']))
				{
					if($orderEntity->id() == $options['oid'])
					{
						return false;
					}
				}
				if($orderEntity->shippingAddress() == $shippingAddress && zbase_date_before(zbase_date_instance($orderEntity->first()->created_at)->addHour(24), zbase_date_now()))
				{
					return $orderEntity;
				}
			}
		}
		return false;
	}

	/**
	 * Display image
	 */
	public function serve()
	{
		/**
		 * Turn off PHP errors, Disable caching and set the Content-Type.
		 */
		ini_set('display_errors', '0');

		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		header("Content-Type: image/png");
		imagepng($this->_image);
		imagedestroy($this->_image);
		/**
		 * Output the image and do a little cleanup.
		 */
		exit();
	}

	public function download()
	{
		/**
		 * Turn off PHP errors, Disable caching and set the Content-Type.
		 */
		ini_set('display_errors', '0');

		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		header("Content-Type: image/png");
		header('Content-Disposition: attachment; filename=zivsluck-order-' . $this->orderData->maskedId() . '.png');
		imagepng($this->_image);
		imagedestroy($this->_image);
		/**
		 * Output the image and do a little cleanup.
		 */
		exit();
	}

	/**
	 * Return the Font Details
	 * @param type $font
	 * @return boolean
	 */
	public function getFontDetails($font = null)
	{
		if(empty($font))
		{
			$font = $this->getFont();
		}
		if(array_key_exists($font, $this->fontMaps))
		{
			return $this->fontMaps[$font];
		}
		return false;
	}

	function getOrderData()
	{
		return $this->orderData;
	}

	function setOrderData(\Zivsluck\Entity\Laravel\Order $orderData)
	{
		$this->orderData = $orderData;
	}

	/**
	 *
	 * @see $this->font
	 */
	public function getFont()
	{
		return $this->font;
	}

	/**
	 * @see $this->text
	 * @return strng
	 */
	public function getText()
	{
		return $this->text;
	}

	/**
	 *
	 * @see $this->font
	 */
	public function setFont($font)
	{
		$this->font = $font;
		return $this;
	}

	/**
	 * @see $this->text
	 */
	public function setText($text)
	{
		$this->text = $text;
		return $this;
	}

}

function imagettftexttexture(&$im, &$textureim, $size, $angle, $x, $y, $fontfile, $text)
{
	$width = imagesx($im); // Get the width of the image
	$height = imagesy($im); // Get the height of the image
	$buffer = imagecreate($width, $height); // Create the buffer image
	$tile_w = imagesx($textureim); // Get the width of the texture image
	$tile_h = imagesy($textureim); // Get the height of the texture image
	$fits_x = (int) ($im_w / $tile_w); // Find out how many times it fits horizontally
	$fits_y = (int) ($im_h / $tile_h); // Find out how many times it fits vertically
	for ($i = 0; $i <= $fits_x; $i++)
	{ // Loop through every time (and another, for extra space) it fits horizontally
		$x = (int) ($tile_w * $i); // Change the X location based on where in the loop it is
		for ($i2 = 0; $i2 <= $fits_y; $i2++)
		{ // Loop through every time it fits vertically
			$y = (int) ($tile_h * $i2); // Change the Y location
			$copy = imagecopy($im, $textureim, $x, $y, 0, 0, $tile_w, $tile_h); // Copy the image to the X,Y location
		}
	}
	$pink = imagecolorclosest($im, 255, 0, 255); // Create magic pink, a color commonly used for masks
	$trans = imagecolortransparent($im, $pink); // Make magic pink the transparent color
	imagettftext($im, $size, $angle, $x, $y, -$pink, $fontfile, $text); // Draw text over magic pink without aliasing
	imagecopy($buffer, $im, 0, 0, 0, 0, $width, $height); // Copy the main image onto the buffer
	imagecopy($im, $buffer, 0, 0, 0, 0, $width, $height); // Copy the buffer back onto the main image
	imagedestroy($buffer); // Destroy the buffer
}
