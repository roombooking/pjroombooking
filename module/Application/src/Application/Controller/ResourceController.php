<?php
    namespace Application\Controller;
    
    use Zend\Mvc\Controller\AbstractActionController;
    use Zend\View\Model\ViewModel;
    use Zend\View\Model\JsonModel;
    
/**
 * ResourceController
 * 
 * The resource controller contains logic to read and modify resources.
 *
 * @author Roombooking Study Project (see AUTHORS.md)
 *
 * @version 0.1
 *
 */
class ResourceController extends AbstractActionController
{
/**
 * 
 * @var Application\Mapper\Resource
 */
private $resourceMapper;

/**
 * 
 * The constructor for the resource controller.
 * 
 * @param Application\Mapper\Resource $resourceMapper
 */
public function __construct($resourceMapper)
{
	$this->resourceMapper = $resourceMapper;
}

/**
 * The index action provies an overview over all hierarchies available.
 * 
 * It aims to provide data for a simple overview page that allows administrators
 * to pick a hierarchy to adminsitrate.
 * 
 * (non-PHPdoc)
 * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
 */
    public function indexAction () {
        /*
         * TODO Define an index action should it become
         * necessary.
         * 
         * The route /resources redirects to this! 
         */
        return new ViewModel(array(
    	   'hierarchies' => $this->resourceMapper->fetchAllHierarchies()
        ));
    }

	/**
 	* Return bookings as JSON response for API use. This action
 	* is vital to the jsTree JavaScript logic (see /public/js/roombooking/roombooking.js)
 	* 
 	* @return \Zend\View\Model\JsonModel
 	*/
    public function containmentAction ()
    {            
        return new JsonModel($this->resourceMapper->fetchAllContainments());
    }
    
    /**
     * Return bookings as JSON response for API use. This action
     * is meant to be used for editing trees (see /public/js/roombooking/edittree.js)
     *
     * @return \Zend\View\Model\JsonModel
     */
    public function containmentByIdAction ()
    {
        $id = $this->params()->fromRoute('id');
        
    	return new JsonModel($this->resourceMapper->fetchContainmentsById($id));
    }
    
    /**
     * This action aims to insert a new resource to a hierarchy.
     * It uses details provided by POST parameters and returns the ID
     * of the new resource as generated by MySQL (autoincrement index).
     *
     * @return \Zend\View\Model\JsonModel
     */
    public function resourcesAction ()
    {   
        
        $hierarchyId = $this->params()->fromRoute('id');
        
    	return new ViewModel(array(
    		'hierarchyId' => $hierarchyId
    	));
    }
    
    /**
     * This action aims to insert a new resource to a hierarchy.
     * It uses details provided by POST parameters and returns the ID
     * of the new resource as generated by MySQL (autoincrement index).
     *
     * @return \Zend\View\Model\JsonModel
     */
    public function addResourcesAction() {
        if ($this->getRequest()->isPost()) {
	/*
	 * TODO Validate?
	 */
            $hierarchyid = $this->params()->fromRoute('hierarchyid');
            $parentId = $this->params()->fromPost('parentId');
            $resourceName = $this->params()->fromPost('resourceName');
            $resourceDescription = $this->params()->fromPost('resourceDescription');
            $resourceType = $this->params()->fromPost('resourceType');
            $bookable = $this->params()->fromPost('bookable');
            
            /**
             * TODO
             *      - Validate POST data
             *        (http://stackoverflow.com/questions/458299/handling-input-with-the-zend-framework-post-get-etc#answer-458312)
             *      - Deciede whether it is a room or equipment
             *      - Insert data to the appropriate tables (ressources + rooms/equipments)
             *      - Return the ID generated by MySQL to the JSON-model (replace 42 below)
             */
            
            return new JsonModel(array(
    			'resourceid' => 42,
    			'success' => true
    		));
        }
    }
	
    /**
     * This action aims to delete a resource from the tree and returns
     * a success flag for the front-end.
     *
     * @return \Zend\View\Model\JsonModel
     */
    public function deleteResourceAction() {
        if ($this->getRequest()->isPost()) {
        	/*
        	 * TODO Validate?
        	 */
            $hierarchyid = $this->params()->fromRoute('hierarchyid');
            $id = $this->params()->fromRoute('id');

        	// TODO
        
        	/*
        	 * TODO return true/false
        	 */
            return new JsonModel(array(
                'success' => true
            ));
        }
    }

    /**
     * This action aims to update the position of a resource through a
     * POST request and returns a JsonModel indicatin wheter the update
     * was successful.
     *
     * @return \Zend\View\Model\JsonModel
     */
    public function updateResourceAction() {
        /*
         * TODO Validate?
         */
        if ($this->getRequest()->isPost()) {
            $hierarchyid = $this->params()->fromRoute('hierarchyid');
            $id = $this->params()->fromRoute('id');
            $parentId = $this->params()->fromRoute('parentId');
        }
        
        // TODO
        
        /*
         * TODO return true/false
         */
        return new JsonModel(array(
            'success' => true
        ));
    }
}