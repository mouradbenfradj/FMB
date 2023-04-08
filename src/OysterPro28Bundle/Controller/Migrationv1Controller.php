<?php

namespace OysterPro28Bundle\Controller;

use OysterPro28Bundle\Entity\ArtCategs;
use OysterPro28Bundle\Entity\Articles;
use OysterPro28Bundle\Entity\ArticlesModeleMateriel;
use OysterPro28Bundle\Entity\StocksArticles;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class Migrationv1Controller extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $cordes = $em->getRepository('OysterPro28Bundle:Corde')->findAll();
        $lanternes = $em->getRepository('OysterPro28Bundle:Lanterne')->findAll();
        $poches = $em->getRepository('OysterPro28Bundle:PochesBS')->findAll();
        $articles = $em->getRepository('OysterPro28Bundle:Articles')->findAll();
        $categ1 = null;
        $categ2 = null;
        $categ = null;
        $ok1 = true;
        $ok2 = true;

        foreach ($articles as $article) {

            if (!$articleModelMateriel = $em->getRepository('OysterPro28Bundle:ArticlesModeleMateriel')->findOneBy(array('refArticle' => $article))) {
                $articleModelMateriel = new ArticlesModeleMateriel();
                $articleModelMateriel->setRefArticle($article);
                $articleModelMateriel->setColisage('');
                $articleModelMateriel->setDureeGarantie(0);
                if (strstr($article->getLibArticle(), 'H3')) {
                    $articleModelMateriel->setPoids(75);
                    $em->persist($articleModelMateriel);
                    $em->flush();
                } elseif (strstr($article->getLibArticle(), 'H2')) {
                    $articleModelMateriel->setPoids(95);$em->persist($articleModelMateriel);
                    $em->flush();
                } elseif (strstr($article->getLibArticle(), 'H1')) {
                    $articleModelMateriel->setPoids(120);
                    $em->persist($articleModelMateriel);
                    $em->flush();
                } elseif (strstr($article->getLibArticle(), 'H000')) {
                    $articleModelMateriel->setPoids(300);
                    $em->persist($articleModelMateriel);
                    $em->flush();
                } elseif (strstr($article->getLibArticle(), 'H0')) {
                    $articleModelMateriel->setPoids(200);
                    $em->persist($articleModelMateriel);
                    $em->flush();
                }


            }
            if (strstr($article->getLibArticle(), 'HUITRE')) {
                if ($artCategs = $em->getRepository('OysterPro28Bundle:ArtCategs')->findOneBy(array('libArtCateg' => 'HUITRES'))) {
                    $ok1 = false;
                    $categ1 = $artCategs;
                } else {
                    $artCategs = new ArtCategs();
                    $ok1 = true;
                    $artCategs->setLibArtCateg('HUITRES');
                    $artCategs->setRefArtCateg('' . uniqid());
                    $artCategs->setDescArtCateg('');
                    $artCategs->setDefautNumeroCompteAchat('');
                    $artCategs->setRestriction('');
                    $artCategs->setDefautNumeroCompteVente('');
                    $artCategs->setDureeDispo(0);
                }
                if ($ok1) {
                    $ok1 = false;
                    $em->persist($artCategs);
                    $categ1 = $artCategs;

                }
                $categ = $categ1;
            }
            if (strstr($article->getLibArticle(), 'MOULE')) {
                if ($artCategs = $em->getRepository('OysterPro28Bundle:ArtCategs')->findOneBy(array('libArtCateg' => 'MOULES'))) {
                    $ok2 = false;
                    $categ2 = $artCategs;

                } else {
                    $artCategs = new ArtCategs();
                    $ok2 = true;
                    $artCategs->setLibArtCateg('MOULES');
                    $artCategs->setRefArtCateg('' . uniqid());
                    $artCategs->setDescArtCateg('');
                    $artCategs->setDefautNumeroCompteAchat('');
                    $artCategs->setRestriction('');
                    $artCategs->setDefautNumeroCompteVente('');
                    $artCategs->setDureeDispo(0);
                }
                if ($ok2) {
                    $ok2 = false;
                    $em->persist($artCategs);
                    $categ2 = $artCategs;

                }
                $categ = $categ2;

            }

            $article->setRefArtCateg($categ);
            $em->merge($article);
            $em->flush();
        }


        foreach ($cordes as $corde) {
            if ($article = $em->getRepository('OysterPro28Bundle:Articles')->findOneBy(array('libArticle' => $corde->getNomCorde()))) {
                if ($stocksArticle = $em->getRepository('OysterPro28Bundle:StocksArticles')->findOneBy(array('refArticle' => $article,'idStock'=>$corde->getParc()->getIdStock()))) {
                    if ($artCategs = $em->getRepository('OysterPro28Bundle:ArtCategs')->findOneBy(array('libArtCateg' => 'CORDE'))) {

                    } else {
                        $artCategs = new ArtCategs();
                        if (strstr($corde->getNomCorde(), 'CORDE')) {
                            if ($artCategs = $em->getRepository('OysterPro28Bundle:ArtCategs')->findOneBy(array('libArtCateg' => 'CORDE'))) {
                                $ok1 = false;
                                $categ1 = $artCategs;
                            } else {
                                $ok1 = true;
                                $artCategs = new ArtCategs();

                                $artCategs->setLibArtCateg('CORDE');
                                $artCategs->setRefArtCateg(uniqid());
                                $artCategs->setDescArtCateg('');
                                $artCategs->setDefautNumeroCompteAchat('');
                                $artCategs->setRestriction('');
                                $artCategs->setDefautNumeroCompteVente('');
                                $artCategs->setDureeDispo(0);
                            }
                            if ($ok1) {
                                $ok1 = false;
                                $em->persist($artCategs);
                                $categ1 = $artCategs;

                            }
                            $categ = $categ1;
                        }

                        $em->persist($artCategs);
                        $article->setRefArtCateg($categ);
                        $em->merge($article);

                        $em->flush();
                    }
                } else {
                    $stocksArticle = new StocksArticles();
                    $stocksArticle->setIdStock($corde->getParc()->getIdStock());
                    $stocksArticle->setRefArticle($article);
                    $stocksArticle->setQte($corde->getNbrTotaleEnStock());
                    $artCategs = new ArtCategs();
                    if (strstr($corde->getNomCorde(), 'CORDE')) {
                        if ($artCategs = $em->getRepository('OysterPro28Bundle:ArtCategs')->findOneBy(array('libArtCateg' => 'CORDE'))) {
                            $ok1 = false;
                            $categ1 = $artCategs;
                        } else {
                            $ok1 = true;
                            $artCategs = new ArtCategs();

                            $artCategs->setLibArtCateg('CORDE');
                            $artCategs->setRefArtCateg(uniqid());
                            $artCategs->setDescArtCateg('');
                            $artCategs->setDefautNumeroCompteAchat('');
                            $artCategs->setRestriction('');
                            $artCategs->setDefautNumeroCompteVente('');
                            $artCategs->setDureeDispo(0);
                        }
                        if ($ok1) {
                            $ok1 = false;
                            $em->persist($artCategs);
                            $categ1 = $artCategs;

                        }
                        $categ = $categ1;
                    }

                    $em->persist($artCategs);
                    $em->persist($stocksArticle);
                    $article->setRefArtCateg($categ);
                    $em->merge($article);

                    $em->flush();
                }
            } else {
                $article = new Articles();
                $article->setRefArticle(uniqid());
                $article->setLibArticle($corde->getNomCorde());
                $article->setLibTicket($corde->getNomCorde());
                $article->setDescCourte('');
                $article->setDescLongue('');
                $article->setModele('');
                $article->setPaaLastMaj(new \DateTime());
                $article->setPromo(0);
                $article->setValoIndice(0);
                $article->setLot(false);
                $article->setComposant(false);
                $article->setVariante(false);
                $article->setGestionSn(false);
                $article->setDateDebutDispo(new \DateTime());
                $article->setDateFinDispo(new \DateTime());
                $article->setDispo(true);
                $article->setDateCreation(new \DateTime());
                $article->setDateModification(new \DateTime());
                $article->setIsAchetable(false);
                $article->setIsVendable(false);
                $stocksArticle = new StocksArticles();
                $stocksArticle->setIdStock($corde->getParc()->getIdStock());
                $stocksArticle->setRefArticle($article);
                $stocksArticle->setQte($corde->getNbrTotaleEnStock());
                $artCategs = new ArtCategs();
                if (strstr($corde->getNomCorde(), 'CORDE')) {
                    if ($artCategs = $em->getRepository('OysterPro28Bundle:ArtCategs')->findOneBy(array('libArtCateg' => 'CORDE'))) {
                        $ok1 = false;
                        $categ1 = $artCategs;
                    } else {
                        $ok1 = true;
                        $artCategs = new ArtCategs();

                        $artCategs->setLibArtCateg('CORDE');
                        $artCategs->setRefArtCateg(uniqid());
                        $artCategs->setDescArtCateg('');
                        $artCategs->setDefautNumeroCompteAchat('');
                        $artCategs->setRestriction('');
                        $artCategs->setDefautNumeroCompteVente('');
                        $artCategs->setDureeDispo(0);
                    }
                    if ($ok1) {
                        $ok1 = false;
                        $em->persist($artCategs);
                        $categ1 = $artCategs;

                    }
                    $categ = $categ1;
                }
                $em->persist($artCategs);
                $em->persist($stocksArticle);
                $article->setRefArtCateg($categ);
                $em->persist($article);

                $em->flush();
            }
        }
        foreach ($lanternes as $lanterne) {
            if ($article = $em->getRepository('OysterPro28Bundle:Articles')->findOneBy(array('libArticle' => $lanterne->getNomLanterne()))) {
                if ($stocksArticle = $em->getRepository('OysterPro28Bundle:StocksArticles')->findOneBy(array('refArticle' => $article,'idStock'=>$lanterne->getParc()->getIdStock()))) {
                    if ($artCategs = $em->getRepository('OysterPro28Bundle:ArtCategs')->findOneBy(array('libArtCateg' => 'LANTERNE'))) {

                    } else {
                        $artCategs = new ArtCategs();
                        if (strstr($lanterne->getNomLanterne(), 'LANTERNE')) {
                            if ($artCategs = $em->getRepository('OysterPro28Bundle:ArtCategs')->findOneBy(array('libArtCateg' => 'LANTERNE'))) {
                                $ok1 = false;
                                $categ1 = $artCategs;
                            } else {
                                $ok1 = true;
                                $artCategs = new ArtCategs();

                                $artCategs->setLibArtCateg('LANTERNE');
                                $artCategs->setRefArtCateg(uniqid());
                                $artCategs->setDescArtCateg('');
                                $artCategs->setDefautNumeroCompteAchat('');
                                $artCategs->setRestriction('');
                                $artCategs->setDefautNumeroCompteVente('');
                                $artCategs->setDureeDispo(0);
                            }
                            if ($ok1) {
                                $ok1 = false;
                                $em->persist($artCategs);
                                $categ1 = $artCategs;

                            }
                            $categ = $categ1;
                        }

                        $em->persist($artCategs);
                        $article->setRefArtCateg($categ);
                        $em->merge($article);

                        $em->flush();
                    }
                } else {
                    $stocksArticle = new StocksArticles();
                    $stocksArticle->setIdStock($lanterne->getParc()->getIdStock());
                    $stocksArticle->setRefArticle($article);
                    $stocksArticle->setQte($lanterne->getNbrTotaleEnStock());
                    $artCategs = new ArtCategs();
                    if (strstr($lanterne->getNomLanterne(), 'LANTERNE')) {
                        if ($artCategs = $em->getRepository('OysterPro28Bundle:ArtCategs')->findOneBy(array('libArtCateg' => 'LANTERNE'))) {
                            $ok1 = false;
                            $categ1 = $artCategs;
                        } else {
                            $ok1 = true;
                            $artCategs = new ArtCategs();

                            $artCategs->setLibArtCateg('LANTERNE');
                            $artCategs->setRefArtCateg(uniqid());
                            $artCategs->setDescArtCateg('');
                            $artCategs->setDefautNumeroCompteAchat('');
                            $artCategs->setRestriction('');
                            $artCategs->setDefautNumeroCompteVente('');
                            $artCategs->setDureeDispo(0);
                        }
                        if ($ok1) {
                            $ok1 = false;
                            $em->persist($artCategs);
                            $categ1 = $artCategs;

                        }
                        $categ = $categ1;
                    }

                    $em->persist($artCategs);
                    $em->persist($stocksArticle);
                    $article->setRefArtCateg($categ);
                    $em->merge($article);

                    $em->flush();
                }
            } else {
                $article = new Articles();
                $article->setRefArticle(uniqid());
                $article->setLibArticle($lanterne->getNomLanterne());
                $article->setLibTicket($lanterne->getNomLanterne());
                $article->setDescCourte('');
                $article->setDescLongue('');
                $article->setModele('');
                $article->setPaaLastMaj(new \DateTime());
                $article->setPromo(0);
                $article->setValoIndice(0);
                $article->setLot(false);
                $article->setComposant(false);
                $article->setVariante(false);
                $article->setGestionSn(false);
                $article->setDateDebutDispo(new \DateTime());
                $article->setDateFinDispo(new \DateTime());
                $article->setDispo(true);
                $article->setDateCreation(new \DateTime());
                $article->setDateModification(new \DateTime());
                $article->setIsAchetable(false);
                $article->setIsVendable(false);
                $stocksArticle = new StocksArticles();
                $stocksArticle->setIdStock($lanterne->getParc()->getIdStock());
                $stocksArticle->setRefArticle($article);
                $stocksArticle->setQte($lanterne->getNbrTotaleEnStock());
                $artCategs = new ArtCategs();
                if (strstr($lanterne->getNomLanterne(), 'LANTERNE')) {
                    if ($artCategs = $em->getRepository('OysterPro28Bundle:ArtCategs')->findOneBy(array('libArtCateg' => 'LANTERNE'))) {
                        $ok1 = false;
                        $categ1 = $artCategs;
                    } else {
                        $ok1 = true;
                        $artCategs = new ArtCategs();

                        $artCategs->setLibArtCateg('LANTERNE');
                        $artCategs->setRefArtCateg(uniqid());
                        $artCategs->setDescArtCateg('');
                        $artCategs->setDefautNumeroCompteAchat('');
                        $artCategs->setRestriction('');
                        $artCategs->setDefautNumeroCompteVente('');
                        $artCategs->setDureeDispo(0);
                    }
                    if ($ok1) {
                        $ok1 = false;
                        $em->persist($artCategs);
                        $categ1 = $artCategs;

                    }
                    $categ = $categ1;
                }
                $em->persist($artCategs);
                $em->persist($stocksArticle);
                $article->setRefArtCateg($categ);
                $em->persist($article);

                $em->flush();
            }
        }
        foreach ($poches as $poche) {
            if ($article = $em->getRepository('OysterPro28Bundle:Articles')->findOneBy(array('libArticle' => $poche->getNomPoche()))) {
                if ($stocksArticle = $em->getRepository('OysterPro28Bundle:StocksArticles')->findOneBy(array('refArticle' => $article,'idStock'=>$poche->getParc()->getIdStock()))) {
                    if ($artCategs = $em->getRepository('OysterPro28Bundle:ArtCategs')->findOneBy(array('libArtCateg' => 'POCHE'))) {

                    } else {
                        $artCategs = new ArtCategs();
                        if (strstr($poche->getNomPoche(), 'POCHE')) {
                            if ($artCategs = $em->getRepository('OysterPro28Bundle:ArtCategs')->findOneBy(array('libArtCateg' => 'POCHE'))) {
                                $ok1 = false;
                                $categ1 = $artCategs;
                            } else {
                                $ok1 = true;
                                $artCategs = new ArtCategs();

                                $artCategs->setLibArtCateg('POCHE');
                                $artCategs->setRefArtCateg(uniqid());
                                $artCategs->setDescArtCateg('');
                                $artCategs->setDefautNumeroCompteAchat('');
                                $artCategs->setRestriction('');
                                $artCategs->setDefautNumeroCompteVente('');
                                $artCategs->setDureeDispo(0);
                            }
                            if ($ok1) {
                                $ok1 = false;
                                $em->persist($artCategs);
                                $categ1 = $artCategs;

                            }
                            $categ = $categ1;
                        }

                        $em->persist($artCategs);
                        $article->setRefArtCateg($categ);
                        $em->merge($article);

                        $em->flush();
                    }
                } else {
                    $stocksArticle = new StocksArticles();
                    $stocksArticle->setIdStock($poche->getParc()->getIdStock());
                    $stocksArticle->setRefArticle($article);
                    $stocksArticle->setQte($poche->getNbrTotaleEnStock());
                    $artCategs = new ArtCategs();
                    if (strstr($poche->getNomPoche(), 'POCHE')) {
                        if ($artCategs = $em->getRepository('OysterPro28Bundle:ArtCategs')->findOneBy(array('libArtCateg' => 'POCHE'))) {
                            $ok1 = false;
                            $categ1 = $artCategs;
                        } else {
                            $ok1 = true;
                            $artCategs = new ArtCategs();

                            $artCategs->setLibArtCateg('POCHE');
                            $artCategs->setRefArtCateg(uniqid());
                            $artCategs->setDescArtCateg('');
                            $artCategs->setDefautNumeroCompteAchat('');
                            $artCategs->setRestriction('');
                            $artCategs->setDefautNumeroCompteVente('');
                            $artCategs->setDureeDispo(0);
                        }
                        if ($ok1) {
                            $ok1 = false;
                            $em->persist($artCategs);
                            $categ1 = $artCategs;

                        }
                        $categ = $categ1;
                    }

                    $em->persist($artCategs);
                    $em->persist($stocksArticle);
                    $article->setRefArtCateg($categ);
                    $em->merge($article);

                    $em->flush();
                }
            } else {
                $article = new Articles();
                $article->setRefArticle(uniqid());
                $article->setLibArticle($poche->getNomPoche());
                $article->setLibTicket($poche->getNomPoche());
                $article->setDescCourte('');
                $article->setDescLongue('');
                $article->setModele('');
                $article->setPaaLastMaj(new \DateTime());
                $article->setPromo(0);
                $article->setValoIndice(0);
                $article->setLot(false);
                $article->setComposant(false);
                $article->setVariante(false);
                $article->setGestionSn(false);
                $article->setDateDebutDispo(new \DateTime());
                $article->setDateFinDispo(new \DateTime());
                $article->setDispo(true);
                $article->setDateCreation(new \DateTime());
                $article->setDateModification(new \DateTime());
                $article->setIsAchetable(false);
                $article->setIsVendable(false);
                $stocksArticle = new StocksArticles();
                $stocksArticle->setIdStock($poche->getParc()->getIdStock());
                $stocksArticle->setRefArticle($article);
                $stocksArticle->setQte($poche->getNbrTotaleEnStock());
                $artCategs = new ArtCategs();
                if (strstr($poche->getNomPoche(), 'POCHE')) {
                    if ($artCategs = $em->getRepository('OysterPro28Bundle:ArtCategs')->findOneBy(array('libArtCateg' => 'POCHE'))) {
                        $ok1 = false;
                        $categ1 = $artCategs;
                    } else {
                        $ok1 = true;
                        $artCategs = new ArtCategs();

                        $artCategs->setLibArtCateg('POCHE');
                        $artCategs->setRefArtCateg(uniqid());
                        $artCategs->setDescArtCateg('');
                        $artCategs->setDefautNumeroCompteAchat('');
                        $artCategs->setRestriction('');
                        $artCategs->setDefautNumeroCompteVente('');
                        $artCategs->setDureeDispo(0);
                    }
                    if ($ok1) {
                        $ok1 = false;
                        $em->persist($artCategs);
                        $categ1 = $artCategs;

                    }
                    $categ = $categ1;
                }
                $em->persist($artCategs);
                $em->persist($stocksArticle);
                $article->setRefArtCateg($categ);
                $em->persist($article);

                $em->flush();
            }
        }

        return $this->render('@OysterPro28/Migration/migration.html.twig');
    }
}
