<?php
    class GeneVariants{
        public $gene;
        public $variants;
        
        function __construct($thisgene, $thisvariants){
            $this->gene = $thisgene;
            $this->variants = $thisvariants;
        }
    }
    
    class Gene{
        public $id;
        public $name;
        
        function __construct($thisid, $thisname){
            $this->id = $thisid;
            $this->name = $thisname;
        }
    }
    
    class Variant{
        public $variantid;
        public $nucleotidechange;
        public $proteinchange;
        public $othermappings;
        public $alias;
        public $transcripts;
        public $region;
        public $reportedclassification;
        public $inferredclassification;
        public $source;
        public $lastevaluated;
        public $lastupdated;
        public $url;
        public $submittercomment;
        public $assembly;
        public $chr;
        public $genomicstart;
        public $genomicstop;
        public $ref;
        public $alt;
        public $reportedref;
        public $reportedalt;
        
        function __construct($thisvariantid, $thisnucleotidechange, $thisproteinchange, $thisothermappings, $thisalias, $thistranscripts, $thisregion, $thisreportedclassification, $thisinferredclassification, $thissource, $thislastevaluated, $thislastupdated, $thisurl, $thissubmittercomment, $thisassembly, $thischr, $thisgeonomicstart, $thisgeonomicstop, $thisref, $thisalt, $thisreportedref, $thisreportedalt){
            $this->variantid = $thisvariantid;
            $this->nucleotidechange = $thisnucleotidechange;
            $this->proteinchange = $thisproteinchange;
            $this->othermappings = $thisothermappings;
            $this->alias = $thisalias;
            $this->transcripts = $thistranscripts;
            $this->region = $thisregion;
            $this->reportedclassification = $thisreportedclassification;
            $this->inferredclassification = $thisinferredclassification;
            $this->source = $thissource;
            $this->lastevaluated = $thislastevaluated;
            $this->lastupdated = $thislastupdated;
            $this->url = $thisurl;
            $this->submittercomment = $thissubmittercomment;
            $this->assembly = $thisassembly;
            $this->chr = $thischr;
            $this->genomicstart = $thisgeonomicstart;
            $this->genomicstop = $thisgeonomicstop;
            $this->ref = $thisref;
            $this->alt = $thisalt;
            $this->reportedref = $thisreportedref;
            $this->reportedalt = $thisreportedalt;
        }
    }
    
    class ResponseError
    {
        const STATUS_INTERNAL_SERVER_ERROR = 500;
        const STATUS_UNPROCESSABLE_ENTITY = 422;

        private $status;
        private $messages;

        public function ResponseError($status, $message = null)
        {
            $this->status = $status;

            if (isset($message)) {
                $this->messages = array(
                    'general' => array($message)
                );
            } else {
                $this->messages = array();
            }
        }

        public function addMessage($key, $message)
        {
            if (!isset($message)) {
                $message = $key;
                $key = 'general';
            }

            if (!isset($this->messages[$key])) {
                $this->messages[$key] = array();
            }

            $this->messages[$key][] = $message;
        }

        public function getMessages()
        {
            return $this->messages;
        }

        public function getStatus()
        {
            return $this->status;
        }
    }

?>