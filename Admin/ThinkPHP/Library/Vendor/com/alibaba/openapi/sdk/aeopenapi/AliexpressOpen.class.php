<?php
namespace Vendor\com\alibaba\openapi\sdk\aeopenapi;

use Vendor\com\alibaba\openapi\client\APIRequest;
use Vendor\com\alibaba\openapi\client\APIId;
use Vendor\com\alibaba\openapi\client\policy\ClientPolicy;
use Vendor\com\alibaba\openapi\client\policy\RequestPolicy;
use Vendor\com\alibaba\openapi\client\SyncAPIClient;
use Vendor\com\alibaba\openapi\client\policy\DataProtocol;
use Vendor\com\alibaba\openapi\client\entity\AuthorizationToken;

/**
 * API调用的入口
 */
class AliexpressOpen {

        private $serverHost = "gw.api.alibaba.com";
	private $httpPort = 80;
	private $httpsPort = 443;
	private $appKey = "2204043";
	private $secKey = "mfm0qwLsatGO";
	private $syncAPIClient;
	
	public function setServerHost($serverHost) {
		$this->serverHost = $serverHost;
	}
	public function setHttpPort($httpPort) {
		$this->httpPort = $httpPort;
	}
	public function setHttpsPort($httpsPort) {
		$this->httpsPort = $httpsPort;
	}
	public function setAppKey($appKey) {
		$this->appKey = $appKey;
	}
	public function setSecKey($secKey) {
		$this->secKey = $secKey;
	}
	public function initClient() {
		$clientPolicy = new ClientPolicy ();
		$clientPolicy->appKey = $this->appKey;
		$clientPolicy->secKey = $this->secKey;
		$clientPolicy->httpPort = $this->httpPort;
		$clientPolicy->httpsPort = $this->httpsPort;
		$clientPolicy->serverHost = $this->serverHost;
		
		$this->syncAPIClient = new SyncAPIClient($clientPolicy);
	}
	
	public function getAPIClient() {
		if ($this->syncAPIClient == null) {
			$this->initClient ();
		}
		return $this->syncAPIClient;
	}

	/**
	 * 根据授权码换取授权令牌
	 * 
	 * @param code 授权码
	 * @return 授权令牌
	 */
	public function getToken($code) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=false;
            $reqPolicy->requestSendTimestamp=true;
            $reqPolicy->useHttps=true;
            $reqPolicy->requestProtocol=DataProtocol::param2;
           
            $request = new APIRequest ();
            $request->addtionalParams["code"]=$code;
            $request->addtionalParams["grant_type"]="authorization_code";
            $request->addtionalParams["need_refresh_token"]=true;
            $request->addtionalParams["client_id"]=$this->appKey;
            $request->addtionalParams["client_secret"]=$this->secKey;
            $request->addtionalParams["redirect_uri"]="default";
            $apiId = new APIId ("system.oauth2", "getToken", $reqPolicy->defaultApiVersion);
            $request->apiId = $apiId;

            $resultDefinition = new AuthorizationToken();
            $this->getAPIClient()->send($request, $resultDefinition, $reqPolicy);
            return $resultDefinition;
	}
	
	
	/**
	 * 刷新token
	 * 
	 * @param refreshToken refresh 令牌
	 * @return 授权令牌
	 */
	public function refreshToken($refreshToken) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=false;
            $reqPolicy->requestSendTimestamp=true;
            $reqPolicy->useHttps=true;
            $reqPolicy->requestProtocol=DataProtocol::param2;

            $request = new APIRequest ();
            $request->addtionalParams["refreshToken"]=$refreshToken;
            $request->addtionalParams["grant_type"]="refresh_token";
            $request->addtionalParams["client_id"]=$this->appKey;
            $request->addtionalParams["client_secret"]=$this->secKey;
//            $apiId = new APIId ("system.oauth2", "refreshToken", $reqPolicy->defaultApiVersion);
            $apiId = new APIId ("system.oauth2", "getToken", $reqPolicy->defaultApiVersion);
            $request->apiId = $apiId;

            $resultDefinition = new AuthorizationToken();
            return $this->getAPIClient()->send($request, $resultDefinition, $reqPolicy);
	}

        public function alibabaAeProductRenewExpire(AlibabaAeProductRenewExpireParam $param,   $accessToken ,  AlibabaAeProductRenewExpireResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "alibaba.ae.product.renewExpire", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function alibabaProductPostMultilanguageAeProduct(AlibabaProductPostMultilanguageAeProductParam $param,   $accessToken ,  AlibabaProductPostMultilanguageAeProductResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "alibaba.product.postMultilanguageAeProduct", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                            
            
           
        public function alibabaAeWarrantieGetList(AlibabaAeWarrantieGetListParam $param ,  AlibabaAeWarrantieGetListResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=false;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "alibaba.ae.warrantie.getList", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
                        
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiUploadTempImage4SDK(ApiUploadTempImage4SDKParam $param,   $accessToken ,  ApiUploadTempImage4SDKResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.uploadTempImage4SDK", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiUploadImage4SDK(ApiUploadImage4SDKParam $param,   $accessToken ,  ApiUploadImage4SDKResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.uploadImage4SDK", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiGetNextLevelAddressData(ApiGetNextLevelAddressDataParam $param,   $accessToken ,  ApiGetNextLevelAddressDataResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.getNextLevelAddressData", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                    			                        
            
           
        public function apiGetAllProvince(  $accessToken ,  ApiGetAllProvinceResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.getAllProvince", 1);
			$request->apiId = $apiId;
                
                        
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                            
            
           
        public function apiQueryWarrantiesInforce(ApiQueryWarrantiesInforceParam $param ,  ApiQueryWarrantiesInforceResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=false;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.queryWarrantiesInforce", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
                        
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                            
            
           
        public function apiQueryIssueListForSpecial(ApiQueryIssueListForSpecialParam $param ,  ApiQueryIssueListForSpecialResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=false;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.queryIssueListForSpecial", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
                        
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                            
            
           
        public function apiQueryWarrantiesByOrderId(ApiQueryWarrantiesByOrderIdParam $param ,  ApiQueryWarrantiesByOrderIdResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=false;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.queryWarrantiesByOrderId", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
                        
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiUpdateMsgProcessed(ApiUpdateMsgProcessedParam $param,   $accessToken ,  ApiUpdateMsgProcessedResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.updateMsgProcessed", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiUpdateMsgRank(ApiUpdateMsgRankParam $param,   $accessToken ,  ApiUpdateMsgRankResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.updateMsgRank", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiQueryMsgDetailListByBuyerId(ApiQueryMsgDetailListByBuyerIdParam $param,   $accessToken ,  ApiQueryMsgDetailListByBuyerIdResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.queryMsgDetailListByBuyerId", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiFindAeProductStatusById(ApiFindAeProductStatusByIdParam $param,   $accessToken ,  ApiFindAeProductStatusByIdResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.findAeProductStatusById", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiQueryMsgRelationList(ApiQueryMsgRelationListParam $param,   $accessToken ,  ApiQueryMsgRelationListResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.queryMsgRelationList", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiUpdateMsgRead(ApiUpdateMsgReadParam $param,   $accessToken ,  ApiUpdateMsgReadResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.updateMsgRead", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiQueryMsgDetailList(ApiQueryMsgDetailListParam $param,   $accessToken ,  ApiQueryMsgDetailListResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.queryMsgDetailList", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiAddMsg(ApiAddMsgParam $param,   $accessToken ,  ApiAddMsgResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.addMsg", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiQueryAccountLevel(ApiQueryAccountLevelParam $param,   $accessToken ,  ApiQueryAccountLevelResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.queryAccountLevel", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiLeaveOrderMessage(ApiLeaveOrderMessageParam $param,   $accessToken ,  ApiLeaveOrderMessageResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.leaveOrderMessage", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiSellerSubmitArbi(ApiSellerSubmitArbiParam $param,   $accessToken ,  ApiSellerSubmitArbiResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.sellerSubmitArbi", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiSellerConrimReceiveGoods(ApiSellerConrimReceiveGoodsParam $param,   $accessToken ,  ApiSellerConrimReceiveGoodsResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.sellerConrimReceiveGoods", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiSellerAbandonReceiveGoods(ApiSellerAbandonReceiveGoodsParam $param,   $accessToken ,  ApiSellerAbandonReceiveGoodsResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.sellerAbandonReceiveGoods", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiSellerRefuseIssue(ApiSellerRefuseIssueParam $param,   $accessToken ,  ApiSellerRefuseIssueResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.sellerRefuseIssue", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiSellerAgreeIssue(ApiSellerAgreeIssueParam $param,   $accessToken ,  ApiSellerAgreeIssueResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.sellerAgreeIssue", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiUploadIssueImage(ApiUploadIssueImageParam $param,   $accessToken ,  ApiUploadIssueImageResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.uploadIssueImage", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiQueryIssueDetail(ApiQueryIssueDetailParam $param,   $accessToken ,  ApiQueryIssueDetailResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.queryIssueDetail", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiQueryIssueList(ApiQueryIssueListParam $param,   $accessToken ,  ApiQueryIssueListResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.queryIssueList", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiFindAeProductProhibitedWords(ApiFindAeProductProhibitedWordsParam $param,   $accessToken ,  ApiFindAeProductProhibitedWordsResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.findAeProductProhibitedWords", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiEditSingleSkuStock(ApiEditSingleSkuStockParam $param,   $accessToken ,  ApiEditSingleSkuStockResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.editSingleSkuStock", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiEditSingleSkuPrice(ApiEditSingleSkuPriceParam $param,   $accessToken ,  ApiEditSingleSkuPriceResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.editSingleSkuPrice", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                            
            
           
        public function pushMessageConfirm(PushMessageConfirmParam $param ,  PushMessageConfirmResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=false;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "push.message.confirm", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
                        
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiEditMultilanguageProduct(ApiEditMultilanguageProductParam $param,   $accessToken ,  ApiEditMultilanguageProductResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.editMultilanguageProduct", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                    			                        
            
           
        public function apiGetRemainingWindows(  $accessToken ,  ApiGetRemainingWindowsResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.getRemainingWindows", 1);
			$request->apiId = $apiId;
                
                        
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiExtendsBuyerAcceptGoodsTime(ApiExtendsBuyerAcceptGoodsTimeParam $param,   $accessToken ,  ApiExtendsBuyerAcceptGoodsTimeResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.extendsBuyerAcceptGoodsTime", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiCreateProductGroup(ApiCreateProductGroupParam $param,   $accessToken ,  ApiCreateProductGroupResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.createProductGroup", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiSetSizeChart(ApiSetSizeChartParam $param,   $accessToken ,  ApiSetSizeChartResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.setSizeChart", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                    			                        
            
           
        public function apiGetWindowProducts(  $accessToken ,  ApiGetWindowProductsResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.getWindowProducts", 1);
			$request->apiId = $apiId;
                
                        
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiFindOrderTradeInfo(ApiFindOrderTradeInfoParam $param,   $accessToken ,  ApiFindOrderTradeInfoResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.findOrderTradeInfo", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiFindOrderReceiptInfo(ApiFindOrderReceiptInfoParam $param,   $accessToken ,  ApiFindOrderReceiptInfoResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.findOrderReceiptInfo", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiFindOrderBaseInfo(ApiFindOrderBaseInfoParam $param,   $accessToken ,  ApiFindOrderBaseInfoResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.findOrderBaseInfo", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiFindOrderListSimpleQuery(ApiFindOrderListSimpleQueryParam $param,   $accessToken ,  ApiFindOrderListSimpleQueryResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.findOrderListSimpleQuery", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiEditProductCategoryAttributes(ApiEditProductCategoryAttributesParam $param,   $accessToken ,  ApiEditProductCategoryAttributesResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.editProductCategoryAttributes", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiSetGroups(ApiSetGroupsParam $param,   $accessToken ,  ApiSetGroupsResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.setGroups", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiUpdateDeliveriedConfirmationFile(ApiUpdateDeliveriedConfirmationFileParam $param,   $accessToken ,  ApiUpdateDeliveriedConfirmationFileResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.updateDeliveriedConfirmationFile", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiQueryProductGroupIdByProductId(ApiQueryProductGroupIdByProductIdParam $param,   $accessToken ,  ApiQueryProductGroupIdByProductIdResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.queryProductGroupIdByProductId", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                    			                        
            
           
        public function apiGetProductGroupList(  $accessToken ,  ApiGetProductGroupListResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.getProductGroupList", 1);
			$request->apiId = $apiId;
                
                        
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiFindLoanListQuery(ApiFindLoanListQueryParam $param,   $accessToken ,  ApiFindLoanListQueryResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.findLoanListQuery", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiQueryProductViewedInfoEverydayById(ApiQueryProductViewedInfoEverydayByIdParam $param,   $accessToken ,  ApiQueryProductViewedInfoEverydayByIdResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.queryProductViewedInfoEverydayById", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiQueryProductAddCartInfoEverydayById(ApiQueryProductAddCartInfoEverydayByIdParam $param,   $accessToken ,  ApiQueryProductAddCartInfoEverydayByIdResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.queryProductAddCartInfoEverydayById", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiQueryProductFavoritedInfoEverydayById(ApiQueryProductFavoritedInfoEverydayByIdParam $param,   $accessToken ,  ApiQueryProductFavoritedInfoEverydayByIdResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.queryProductFavoritedInfoEverydayById", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiEditProductCidAttIdSku(ApiEditProductCidAttIdSkuParam $param,   $accessToken ,  ApiEditProductCidAttIdSkuResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.editProductCidAttIdSku", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiEditSimpleProductFiled(ApiEditSimpleProductFiledParam $param,   $accessToken ,  ApiEditSimpleProductFiledResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.editSimpleProductFiled", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiSellerModifiedShipment(ApiSellerModifiedShipmentParam $param,   $accessToken ,  ApiSellerModifiedShipmentResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.sellerModifiedShipment", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiQueryOpenAnouncement(ApiQueryOpenAnouncementParam $param,   $accessToken ,  ApiQueryOpenAnouncementResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.queryOpenAnouncement", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiClaimTaobaoProducts4API(ApiClaimTaobaoProducts4APIParam $param,   $accessToken ,  ApiClaimTaobaoProducts4APIResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.claimTaobaoProducts4API", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiSetShopwindowProduct(ApiSetShopwindowProductParam $param,   $accessToken ,  ApiSetShopwindowProductResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.setShopwindowProduct", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiGetOnlineLogisticsInfo(ApiGetOnlineLogisticsInfoParam $param,   $accessToken ,  ApiGetOnlineLogisticsInfoResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.getOnlineLogisticsInfo", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            return $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiGetOnlineLogisticsServiceListByOrderId(ApiGetOnlineLogisticsServiceListByOrderIdParam $param,   $accessToken ,  ApiGetOnlineLogisticsServiceListByOrderIdResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.getOnlineLogisticsServiceListByOrderId", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            return $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiCreateWarehouseOrder(ApiCreateWarehouseOrderParam $param,   $accessToken ,  ApiCreateWarehouseOrderResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.createWarehouseOrder", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            return $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }

        public function apiQureyWlbDomesticLogisticsCompany(  $accessToken ,  ApiQureyWlbDomesticLogisticsCompanyResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.qureyWlbDomesticLogisticsCompany", 1);
			$request->apiId = $apiId;
                
                        
            $request->accessToken=$accessToken;            
            return $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                    			                        
            
           
        public function apiGetPhotoBankInfo(  $accessToken ,  ApiGetPhotoBankInfoResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.getPhotoBankInfo", 1);
			$request->apiId = $apiId;
                
                        
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiDelUnUsePhoto(ApiDelUnUsePhotoParam $param,   $accessToken ,  ApiDelUnUsePhotoResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.delUnUsePhoto", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiQueryPromiseTemplateById(ApiQueryPromiseTemplateByIdParam $param,   $accessToken ,  ApiQueryPromiseTemplateByIdResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.queryPromiseTemplateById", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiListTbProductByIds(ApiListTbProductByIdsParam $param,   $accessToken ,  ApiListTbProductByIdsResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.listTbProductByIds", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                    			                        
            
           
        public function apiListLogisticsService(  $accessToken ,  ApiListLogisticsServiceResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.listLogisticsService", 1);
			$request->apiId = $apiId;
                
                        
            $request->accessToken=$accessToken;            
            return $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiSellerShipment(ApiSellerShipmentParam $param,   $accessToken ,  ApiSellerShipmentResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.sellerShipment", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            return $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiQueryTrackingResult(ApiQueryTrackingResultParam $param,   $accessToken ,  ApiQueryTrackingResultResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.queryTrackingResult", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiFindOrderListQuery(ApiFindOrderListQueryParam $param,   $accessToken ,  ApiFindOrderListQueryResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
            $reqPolicy->responseProtocol=DataProtocol::json;
           
            $request = new APIRequest ();
            $apiId = new APIId ("aliexpress.open", "api.findOrderListQuery", 1);
            $request->apiId = $apiId;
           
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            return $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
         
        
	public function apiFindOrderDetailInfo(ApiFindOrderDetailInfoParam $param, $accessToken) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
            $reqPolicy->responseProtocol=DataProtocol::json;
           
            $request = new APIRequest ();
            $apiId = new APIId ("aliexpress.open", "api.findOrderById", 1);
            $request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            return $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }

        
        public function apiGetPrintInfo(ApiGetPrintInfoParam $param, $accessToken) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
            $reqPolicy->responseProtocol=DataProtocol::json;
           
            $request = new APIRequest ();
            $apiId = new APIId ("aliexpress.open", "api.getPrintInfo", 1);
            $request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            return $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
        
        public function apiGetLogisticsSellerAddresses(ApiGetLogisticsSellerAddressesParam $param, $accessToken) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
            $reqPolicy->responseProtocol=DataProtocol::json;
           
            $request = new APIRequest ();
            $apiId = new APIId ("aliexpress.open", "alibaba.ae.api.getLogisticsSellerAddresses", 1);
            $request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            return $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
           
        public function apiFindAeProductDetailModuleListByQurey(ApiFindAeProductDetailModuleListByQureyParam $param,   $accessToken ,  ApiFindAeProductDetailModuleListByQureyResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.findAeProductDetailModuleListByQurey", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiFindAeProductModuleById(ApiFindAeProductModuleByIdParam $param,   $accessToken ,  ApiFindAeProductModuleByIdResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.findAeProductModuleById", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiOnlineAeProduct(ApiOnlineAeProductParam $param,   $accessToken ,  ApiOnlineAeProductResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.onlineAeProduct", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiOfflineAeProduct(ApiOfflineAeProductParam $param,   $accessToken ,  ApiOfflineAeProductResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.offlineAeProduct", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiEditAeProduct(ApiEditAeProductParam $param,   $accessToken ,  ApiEditAeProductResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.editAeProduct", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiFindProductInfoListQueryV2(ApiFindProductInfoListQueryV2Param $param,   $accessToken ,  ApiFindProductInfoListQueryV2Result $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=false;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.findProductInfoListQuery", 2);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiFindProductInfoListQuery(ApiFindProductInfoListQueryParam $param,   $accessToken ,  ApiFindProductInfoListQueryResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.findProductInfoListQuery", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiUploadImage(ApiUploadImageParam $param,   $accessToken ,  ApiUploadImageResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.uploadImage", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiListGroup(ApiListGroupParam $param,   $accessToken ,  ApiListGroupResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.listGroup", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiListImagePagination(ApiListImagePaginationParam $param,   $accessToken ,  ApiListImagePaginationResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.listImagePagination", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiUploadTempImage(ApiUploadTempImageParam $param,   $accessToken ,  ApiUploadTempImageResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=false;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.uploadTempImage", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiCalculateFreight(ApiCalculateFreightParam $param,   $accessToken ,  ApiCalculateFreightResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.calculateFreight", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
                                                        
            
           
        public function apiPostAeProduct(ApiPostAeProductParam $param,   $accessToken ,  ApiPostAeProductResult $resultDefinition) {
            $reqPolicy = new RequestPolicy();
            $reqPolicy->httpMethod="POST";
            $reqPolicy->needAuthorization=true;
            $reqPolicy->requestSendTimestamp=false;
            $reqPolicy->useHttps=false;
            $reqPolicy->useSignture=true;
            $reqPolicy->accessPrivateApi=false;
           
            $request = new APIRequest ();
			$apiId = new APIId ("aliexpress.open", "api.postAeProduct", 1);
			$request->apiId = $apiId;
                
            $request->requestEntity=$param;            
            $request->accessToken=$accessToken;            
            $this->getAPIClient()->send($request, $resultDefinition,
						$reqPolicy);
        }
           
}
?>