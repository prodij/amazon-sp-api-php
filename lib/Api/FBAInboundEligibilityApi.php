<?php
/**
 * FBA Inbound Eligibility API.
 *
 * @author  James Han
 */

/**
 * Selling Partner API for FBA Inbound Eligibility.
 *
 * With the FBA Inbound Eligibility API, you can build applications that let sellers get eligibility previews for items before shipping them to Amazon's fulfillment centers. 
 * With this API you can find out if an item is eligible for inbound shipment to Amazon's fulfillment centers in a specific marketplace. 
 * You can also find out if an item is eligible for using the manufacturer barcode for FBA inventory tracking. 
 * Sellers can use this information to inform their decisions about which items to ship Amazon's fulfillment centers.
 *
 */

namespace ClouSale\AmazonSellingPartnerAPI\Api;

use ClouSale\AmazonSellingPartnerAPI\ApiException;
use ClouSale\AmazonSellingPartnerAPI\Configuration;
use ClouSale\AmazonSellingPartnerAPI\HeaderSelector;
use ClouSale\AmazonSellingPartnerAPI\Helpers\SellingPartnerApiRequest;
use ClouSale\AmazonSellingPartnerAPI\Models\FbaInboundEligibility\GetItemEligibilityPreviewResponse;
use ClouSale\AmazonSellingPartnerAPI\ObjectSerializer;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Request;
use InvalidArgumentException;

/**
 * FbaInboundEligibilityApi Class Doc Comment.
 *
 * @author   James Han
 */
class FbaInboundEligibilityApi
{
    use SellingPartnerApiRequest;

    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    public function __construct(Configuration $config)
    {
        $this->client = new Client();
        $this->config = $config;
        $this->headerSelector = new HeaderSelector();
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation getItemEligibilityPreview.
     *
     * @param string $marketplace_id A marketplace identifier. Specifies the marketplace for the item. (required)
     * @param string $asin           The Amazon Standard Identification Number (ASIN) of the item. (required)
     *
     * @throws ApiException             on non-2xx response
     * @throws InvalidArgumentException
     *
     * @return \ClouSale\AmazonSellingPartnerAPI\Models\FbaInboundEligibility\ItemEligibilityPreviewResponse
     */
    public function getItemEligibilityPreview($marketplace_id, $asin, $program)
    {
        list($response) = $this->getItemEligibilityPreviewWithHttpInfo($marketplace_id, $asin, $program);

        return $response;
    }

    /**
     * Operation getItemEligibilityPreviewWithHttpInfo.
     *
     * @param string $marketplace_id A marketplace identifier. Specifies the marketplace for the item. (required)
     * @param string $asin           The Amazon Standard Identification Number (ASIN) of the item. (required)
     *
     * @throws ApiException             on non-2xx response
     * @throws InvalidArgumentException
     *
     * @return array of \ClouSale\AmazonSellingPartnerAPI\Models\FbaInboundEligibility\GetItemEligibilityPreviewResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getItemEligibilityPreviewWithHttpInfo($marketplace_id, $asin, $program)
    {
        $request = $this->getItemEligibilityPreviewRequest($marketplace_id, $asin, $program);

        return $this->sendRequest($request, GetItemEligibilityPreviewResponse::class);
    }

    /**
     * Operation getItemEligibilityPreviewAsync.
     *
     * @param string $marketplace_id A marketplace identifier. Specifies the marketplace for the item. (required)
     * @param string $asin           The Amazon Standard Identification Number (ASIN) of the item. (required)
     *
     * @throws InvalidArgumentException
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getItemEligibilityPreviewAsync($marketplace_id, $asin, $program)
    {
        return $this->getItemEligibilityPreviewAsyncWithHttpInfo($marketplace_id, $asin, $program)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getItemEligibilityPreviewAsyncWithHttpInfo.
     *
     * @param string $marketplace_id A marketplace identifier. Specifies the marketplace for the item. (required)
     * @param string $asin           The Amazon Standard Identification Number (ASIN) of the item. (required)
     *
     * @throws InvalidArgumentException
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getItemEligibilityPreviewAsyncWithHttpInfo($marketplace_id, $asin, $program)
    {
        $request = $this->getItemEligibilityPreviewRequest($marketplace_id, $asin, $program);

        return $this->sendRequestAsync($request, GetItemEligibilityPreviewResponse::class);
    }

    /**
     * Create request for operation 'getItemEligibilityPreview'.
     *
     * @param string $marketplace_id A marketplace identifier. Specifies the marketplace for the item. (required)
     * @param string $asin           The Amazon Standard Identification Number (ASIN) of the item. (required)
     *
     * @throws InvalidArgumentException
     *
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function getItemEligibilityPreviewRequest($marketplace_id, $asin, $program)
    {
        // verify the required parameter 'marketplace_id' is set
        if (null === $marketplace_id || (is_array($marketplace_id) && 0 === count($marketplace_id))) {
            throw new InvalidArgumentException('Missing the required parameter $marketplace_id when calling getItemEligibilityPreview');
        }
        // verify the required parameter 'asin' is set
        if (null === $asin || (is_array($asin) && 0 === count($asin))) {
            throw new InvalidArgumentException('Missing the required parameter $asin when calling getItemEligibilityPreview');
        }
        // verify the required parameter 'program' is set
        if (null === $program || (is_array($program) && 0 === count($program))) {
            throw new InvalidArgumentException('Missing the required parameter $program when calling getItemEligibilityPreview');
        }

        $resourcePath = '/fba/inbound/v1/eligibility/itemPreview';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if (null !== $asin) {
            $queryParams['asin'] = ObjectSerializer::toQueryValue($asin);
        }
        // query params
        if (null !== $marketplace_id) {
            $queryParams['MarketplaceId'] = ObjectSerializer::toQueryValue($marketplace_id);
        }
        // query params
        if (null !== $marketplace_id) {
            $queryParams['program'] = ObjectSerializer::toQueryValue($program);
        }
        
        return $this->generateRequest($multipart, $formParams, $queryParams, $resourcePath, $headerParams, 'GET', $httpBody);
    }
}
