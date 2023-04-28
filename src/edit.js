/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps, RichText, InspectorControls } from '@wordpress/block-editor';

import {
	TextControl,
	PanelBody,
	PanelRow,
	DatePicker,
	ExternalLink,
	ToggleControl,
	__experimentalHeading as Heading,
	__experimentalText as Text, View
} from '@wordpress/components';

import { useState } from '@wordpress/element';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {WPElement} Element to render.
 */
export default function Edit(

	{
		attributes: {
			widgetAvailableTitle, widgetAvailableText, widgetAvailableURL, widgetAvailableButtonText,
			widgetSoonTitle, widgetSoonText, widgetSoonURL, widgetSoonButtonText,
			widgetUnavailableTitle, widgetUnavailableText,
			widgetAvailableGlobalDateOverride, widgetAvailableDate,
			widgetSoonGlobalDateOverride, widgetSoonDate
		},
		setAttributes,
		context: { postType, postId },

	},



) {

	const onChangeAvailableURL = (newWidgetAvailableURL) => {
		setAttributes({ widgetAvailableURL: newWidgetAvailableURL })
	}

	const onUpdateAvailableDate = (dateTime) => {
		var newDateTime = moment(dateTime).format('YYYY-MM-DD HH:mm');
		setAttributes({ widgetAvailableDate: newDateTime });
	};

	const onUpdateSoonDate = (dateTime) => {
		var newDateTime = moment(dateTime).format('YYYY-MM-DD HH:mm');
		setAttributes({ widgetSoonDate: newDateTime });
	};

	const setGlobalOveride = useState(false);

	return (
		<div  {...useBlockProps()} >
			<InspectorControls>
				<PanelBody
					title={__('Freelance Widget - Available', 'freelance-availability-widget')}
					initialOpen={true}
				>
					<PanelRow>
						<fieldset>
							<TextControl
								label={__('Available URL link', 'freelance-availability-widget')}
								value={widgetAvailableURL}
								onChange={onChangeAvailableURL}
								help={__('Add your link to the button that appears when you are available', 'freelance-availability-widget')}
							/>
						</fieldset>
					</PanelRow>
					<PanelRow>
						<fieldset>
							<TextControl
								label={__('Available Button Text', 'freelance-availability-widget')}
								value={widgetAvailableButtonText}
								onChange={(newWidgetAvailableButtonText) =>
									setAttributes({ widgetAvailableButtonText: newWidgetAvailableButtonText })
								}
								help={__('Add the text to the button that appears when you are available', 'freelance-availability-widget')}
							/>
						</fieldset>
					</PanelRow>
					<PanelRow>
						<fieldset>
							<ToggleControl
								label={__('Override Global Available Settings', 'freelance-availability-widget')}
								checked={widgetAvailableGlobalDateOverride}
								onChange = {() => setAttributes({widgetAvailableGlobalDateOverride: !widgetAvailableGlobalDateOverride })}
								help={__('Toggle on to use the "Availablity Date" settings below', 'freelance-availability-widget')}
							/>
						</fieldset>
					</PanelRow>
					<PanelRow>
						<fieldset>
							<Heading>{__('Availability Date', 'freelance-availability-widget')}</Heading>
							<Text>{__('Select a date for when you wish to mark yourself as being available. The "Avaiable" box, with a button, will show after this date. This will only be used if the "Override Global Available" setting is toggled on.', 'freelance-availability-widget')}</Text>
							<DatePicker
								currentDate={widgetAvailableDate}
								onChange={(newWidgetAvailableDate) => onUpdateAvailableDate(newWidgetAvailableDate)}
								help={__('Set the date that the "Available" widget appears', 'freelance-availability-widget')}
							/>
						</fieldset>
					</PanelRow>
				</PanelBody>

				<PanelBody
					title={__('Freelance Widget - Soon', 'freelance-availability-widget')}
					initialOpen={false}
				>
					<PanelRow>
						<fieldset>
							<TextControl
								label={__('Soon to be Available URL link', 'freelance-availability-widget')}
								value={widgetSoonURL}
								onChange={(newWidgetSoonURL) =>
									setAttributes({ widgetSoonURL: newWidgetSoonURL })
								}
								help={__('Add your link to the button that appears when you soon to be  are available', 'freelance-availability-widget')}
							/>
						</fieldset>
					</PanelRow>
					<PanelRow>
						<fieldset>
							<TextControl
								label={__('Soon to be Available Button Text', 'freelance-availability-widget')}
								value={widgetSoonButtonText}
								onChange={(newWidgetSoonButtonText) =>
									setAttributes({ widgetSoonButtonText: newWidgetSoonButtonText })
								}
							/>
						</fieldset>
					</PanelRow>
					<PanelRow>
						<fieldset>
							<ToggleControl
								label={__('Override Global Soon to be Available Settings', 'freelance-availability-widget')}
								checked={widgetSoonGlobalDateOverride}
								onChange = {() => setAttributes({widgetSoonGlobalDateOverride: !widgetSoonGlobalDateOverride })}
								help={__('Toggle on to use the "Soon to be available Date" settings below', 'freelance-availability-widget')}
							/>
						</fieldset>
					</PanelRow>
					<PanelRow>
						<fieldset>
							<Heading>{__('Soon to be Available Date', 'freelance-availability-widget')}</Heading>
							<Text>{__('Select a date for when you wish to mark yourself as to soon to be available. The "Soon" box, with a button, will show after this date. This will only be used if the "Override Soon to be Available" setting is toggled on.', 'freelance-availability-widget')}</Text>
							<DatePicker
								currentDate={widgetSoonDate}
								onChange={(newWidgetSoonDate) => onUpdateSoonDate(newWidgetSoonDate)}
							/>
						</fieldset>
					</PanelRow>
				</PanelBody>
			</InspectorControls>
			<div class="faw-admin-availability-box faw-availability-box-available">
				<h2 class="faw-heading">
					{__(
						'Available Settings',
						'freelance-availability-widget'
					)}
				</h2>
				<p class="faw-admin-notice">
					{__(
						'The information below will appear when you are available, along with a button to a link specified in the sidebar.',
						'freelance-availability-widget'
					)}
				</p>
			</div>

			<RichText
				tagName="h3"
				placeholder={__('I am available!', 'freelance-availability-widget')}
				allowedFormats={[]}
				disableLineBreaks
				value={widgetAvailableTitle}
				onChange={(newWidgetAvailableTitle) =>
					setAttributes({ widgetAvailableTitle: newWidgetAvailableTitle })
				}
			/>
			<p>
				<RichText
					tagName="span"
					placeholder={__('I am available for hire, please click the link below', 'freelance-availability-widget')}
					allowedFormats={['core/bold', 'core/italic']}
					disableLineBreaks
					value={widgetAvailableText}
					onChange={(newWidgetAvailableText) =>
						setAttributes({ widgetAvailableText: newWidgetAvailableText })
					}
				/>
			</p>

			<div class="faw-admin-availability-box faw-availability-box-soon">
				<h2 class="faw-heading">
					{__(
						'Soon to be Available Settings',
						'freelance-availability-widget'
					)}
				</h2>
				<p class="faw-admin-notice">
					{__(
						'The information below will appear when you are not available but will be shortly, along with a button to a link specified in the sidebar.',
						'freelance-availability-widget'
					)}
				</p>
			</div>
			<RichText
				tagName="h3"
				placeholder={__('I am available soon!', 'freelance-availability-widget')}
				allowedFormats={[]}
				disableLineBreaks
				value={widgetSoonTitle}
				onChange={(newWidgetSoonTitle) =>
					setAttributes({ widgetSoonTitle: newWidgetSoonTitle })
				}
			/>
			<p>
				<RichText
					tagName="span"
					placeholder={__('I am available for hire soon, please click the link below', 'freelance-availability-widget')}
					allowedFormats={['core/bold', 'core/italic']}
					disableLineBreaks
					value={widgetSoonText}
					onChange={(newWidgetSoonText) =>
						setAttributes({ widgetSoonText: newWidgetSoonText })
					}
				/>
			</p>
			<div class="faw-admin-availability-box faw-availability-box-unavailable">
				<h2 class="faw-heading">
					{__(
						'Unavailable Settings',
						'freelance-availability-widget'
					)}
				</h2>
				<p class="faw-admin-notice">
					{__(
						'The information below will appear when you are unavailable.',
						'freelance-availability-widget'
					)}
				</p>
			</div>
			<RichText
				tagName="h3"
				placeholder={__('I am Unavailable!', 'freelance-availability-widget')}
				allowedFormats={[]}
				disableLineBreaks
				value={widgetUnavailableTitle}
				onChange={(newWidgetUnavailableTitle) =>
					setAttributes({ widgetUnavailableTitle: newWidgetUnavailableTitle })
				}
			/>
			<p>
				<RichText
					tagName="span"
					placeholder={__('I am unavailable for hire.', 'freelance-availability-widget')}
					allowedFormats={['core/bold', 'core/italic']}
					disableLineBreaks
					value={widgetUnavailableText}
					onChange={(newWidgetUnavailableText) =>
						setAttributes({ widgetUnavailableText: newWidgetUnavailableText })
					}
				/>
			</p>
		</div>

	);
}
