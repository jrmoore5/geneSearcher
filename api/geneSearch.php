<?php
    header('Access-Control-Allow-Origin: *');
    session_start();
    
    include '../includes/database.php';
    include '../includes/classes.php';
    
    if(isset($_GET['query'])){
        try{
            switch(trim(strtolower($_GET['query']))){
                case 'searchgene':
                    if(isset($_GET['gene'])){
                        $gene = $_GET['gene'];
                        
                        $query = "CALL getGeneByStartsWith";
                        $params = array($gene);
                        
                        $result = execute_db($query, $params);
                        
                        $genes = array();
                        while($row = $result->fetch(PDO::FETCH_ASSOC)){
                            $genes[] = new Gene($row['GeneID'], $row['Name']);
                        }
                        http_response_code(200);
                        print json_encode($genes, JSON_PRETTY_PRINT);
                    }
                    else{
                        throw new Exception('searchGene query missing "gene" query string');
                    }
                    break;
                case 'searchvariants':
                    if(isset($_GET['gene'])){
                        $gene = $_GET['gene'];

                        $query = "CALL getVariantsByName";
                        $params = array($gene);

                        $result = execute_db($query, $params);

                        $variants = array();
                        $success = false;
                        
                        while($row = $result->fetch(PDO::FETCH_ASSOC)){
                            $success = $row['Success'];
                            $variants[] = new Variant($row['VariantID'], $row['NucleotideChange'], $row['ProteinChange'], $row['OtherMappings'], $row['Alias'], $row['Transcripts'], $row['Region'], $row['ReportedClassification'], $row['InferredClassification'], $row['Source'], $row['LastEvaluated'], $row['LastUpdated'], $row['URL'], $row['SubmitterComment'], $row['Assembly'], $row['Chr'], $row['GenomicStart'], $row['GenomicStop'], $row['Ref'], $row['Alt'], $row['ReportedRef'], $row['ReportedAlt']);
                        }
                        
                        if($success){
                            http_response_code(200);
                            print json_encode($variants, JSON_PRETTY_PRINT);
                        }
                        else{
                            throw new Exception('Gene does not exist in database');
                        }

                        
                    }
                    else{
                        throw new Exception('searchVariants query missing "gene" query string');
                    }
                    break;
                default:
                    $message = 'Incorrect Query String "query"<br><br>Queries Available: searchGene (http://development.eggheads.io/gene/api/geneSearch?query=searchGene&gene=[string])<br>searchVariants (http://development.eggheads.io/gene/api/geneSearch?query=searchVariants&gene=[string])';

                    throw new Exception($message);
                    break;
            }
        }
        catch(Exception $ex){
            return new ResponseError(ResponseError::STATUS_UNPROCESSABLE_ENTITY , $ex->getMessage());
        }
    }
    else{
        $message = 'Missing queryString "query"<br><br>Queries Available: searchGene (http://development.eggheads.io/gene/api/geneSearch?query=searchGene&gene=[string])<br>searchVariants (http://development.eggheads.io/gene/api/geneSearch?query=searchVariants&gene=[string])';
        
        return new ResponseError(ResponseError::STATUS_UNPROCESSABLE_ENTITY , $message);
    }
    
?>