/************************************************************************
 ** This file is part of the network simulator Shawn.                  **
 ** Copyright (C) 2004-2007 by the SwarmNet (www.swarmnet.de) project  **
 ** Shawn is free software; you can redistribute it and/or modify it   **
 ** under the terms of the BSD License. Refer to the shawn-licence.txt **
 ** file in the root of the Shawn source tree for further details.     **
 ************************************************************************/
#ifndef __SHAWN_APPS_LOCALIZATION_MODULES_DISTANCE_EUCLIDEAN_MODULE_H
#define __SHAWN_APPS_LOCALIZATION_MODULES_DISTANCE_EUCLIDEAN_MODULE_H

#include "_apps_enable_cmake.h"
#ifdef ENABLE_LOCALIZATION

#include <list>

#include "sys/node.h"
#include "apps/localization/modules/localization_module.h"
#include "apps/localization/messages/distance/localization_euclidean_messages.h"
#include "apps/localization/util/localization_defutils.h"


namespace localization
{

   ///@name euclidean module parameters
   ///@{
   const std::string EUCL_COL_CHECK_STD[] = { "lax", "strict", "one" };
   const std::string EUCL_COL_CHECK_NV[] = { "lax", "strict", "one" };
   const std::string EUCL_COL_CHECK_CN[] = { "lax", "strict", "one" };
   const std::string EUCL_ALGO[] = { "normal", "opt" };
   const std::string EUCL_VOTE[] = { "nv", "cn", "nvcn", "cnnv" };
   ///@}


   /// Module implementing euclidean distance estimation
   /** This module implements euclidean distance estimation. Idea is to
    *  compute the real distances to anchors.
    *
    *  If unknown receives a message from two neighbors that know their
    *  distance to an anchor and each other, unknown is able to get two
    *  possible distances to the anchor via trilateration. One of these
    *  distances is right, the other is wrong. To decide, which of these
    *  distances is right, there are two different methods, named
    *  'neighbor vote' and 'common neighbor'.
    *
    *  The first, 'neighbor vote', needs at least one more neighbor, that has
    *  a distance to the anchor and one of the first mentioned neighbors. Now
    *  the trilateration is done a second time, resulting again in two
    *  distances. Then you take the distances of first and second pair, which
    *  are nearest to each other.
    *
    *  Second method, 'common neighbor', needs one more neighbor that has a
    *  distance to the anchor and both of first mentioned neighbors. Basic
    *  geometric reasoning leads to the right solution.
    */
   class LocalizationEuclideanModule
      : public LocalizationModule
   {

   public:

      ///@name construction / destruction
      ///@{
      ///
      LocalizationEuclideanModule();
      ///
      virtual ~LocalizationEuclideanModule();
      ///@}


      ///@name standard methods startup/simulation steps
      ///@{
      /** Read given parameters.
       *
       *  \sa init_parameters(), LocalizationModule::boot()
       */
      virtual void boot( void ) throw();
      /** Handling of Euclidean-Messages.
       *
       *  \sa LocalizationModule::process_message()
       */
      virtual bool process_message( const shawn::ConstMessageHandle& ) throw();
      /** Check, whether state can be set to finished or not. Moreover, send
       *  initial messages.
       *
       *  \sa LocalizationModule::work()
       */
      virtual void work( void ) throw();
      ///@}


      ///@name module status info
      ///@{
      /** \return \c true, if module is finished. \c false otherwise
       *  \sa LocalizationModule::finished()
       */
      virtual bool finished( void ) throw();
      ///@}

		virtual void rollback( void ) throw(); 


   protected:

      ///@name processing euclidean messages
      ///@{
      /** This method processes initial messages. Source of message is added
       *  to neighborhood.
       *
       *  \sa LocalizationEuclideanInitMessage
       */
      virtual bool process_euclidean_init_message(
            const LocalizationEuclideanInitMessage& )
         throw();
      /** This method broadcasts the neighborhood generated by the initial
       *  messages.
       *
       *  \sa LocalizationEuclideanNeighborMessage
       */
      virtual void broadcast_neighborhood( void ) throw();
      /** This method processes neighborhood messages. The neighbors of
       *  message source are added to neighborhood.
       *
       *  \sa LocalizationEuclideanNeighborMessage
       */
      virtual bool process_euclidean_neighbor_message(
            const LocalizationEuclideanNeighborMessage& )
         throw();
      /** This method processes anchor messages. The message tells, that a
       *  neighbor got a distance to some anchor. New information is added
       *  to neighborhood and the module tries to estimate/compute distance
       *  to mentioned anchor.
       *
       *  \sa LocalizationEuclideanAnchorMessage, execute_euclidean()
       */
      virtual bool process_euclidean_anchor_message(
            const LocalizationEuclideanAnchorMessage& )
         throw();
      /** This method tries to estimate/compute a new anchor distance.
       *
       *  \param Node given anchor
       *  \sa find_anchor_distance(), find_anchor_distance_opt()
       */
      virtual void execute_euclidean( const shawn::Node& )
         throw();
      ///@}


      ///@name work on neighborhood
      ///@{
      /** This method searches for two valid neighbors, that know their
       *  distance to given anchor and each other. If found, it tries to apply
       *  as well mentioned 'neighbor vote' as 'common neighbor'.
       *
       *  Per parameters you can tell, if just one or both methods are used.
       *
       *  If wanted solution is reached, the search ends.
       *
       *  \param Node given anchor
       *  \sa find_anchor_distance_opt()
       */
      virtual double find_anchor_distance( const shawn::Node& )
         const throw();
      /** This method searches for two valid neighbors, that know their
       *  distance to given anchor and each other. If found, it tries to apply
       *  as well mentioned 'neighbor vote' as 'common neighbor'.
       *
       *  Unlike find_anchor_distance(), it just searches a 'common neighbor'
       *  for both vote methods. Because of some problems with collinear nodes
       *  it takes the 'fewest collinear' solution.
       *
       *  \param Node given anchor
       *  \sa find_anchor_distance()
       */
      virtual double find_anchor_distance_opt( const shawn::Node& )
         const throw();
      /** There are an anchor and two neighbors given. This method searches
       *  for all neighbors, that either are neighbors of first or second, and
       *  have a link to self and anchor.
       *
       *  \param Node given anchor
       *  \param Node first neighbor
       *  \param Node second neighbor
       *  \return NodeList above mentioned neighbors
       *  \sa find_common_neighbor_neighbors(),
       *    find_common_neighbor_neighbors_opt()
       */
      virtual const localization::NodeList find_unique_neighbor_neighbors(
            const shawn::Node&, const shawn::Node&, const shawn::Node& )
         const throw();
      /** There are an anchor and two neighbors given. This method searches
       *  for all neighbors, that are neighbors of first and second, and
       *  have a link to self and anchor.
       *
       *  \param Node given anchor
       *  \param Node first neighbor
       *  \param Node second neighbor
       *  \return NodeList above mentioned neighbors
       *  \sa find_unique_neighbor_neighbors(),
       *    find_common_neighbor_neighbors_opt()
       */
      virtual const localization::NodeList find_common_neighbor_neighbors(
            const shawn::Node&, const shawn::Node&, const shawn::Node& )
         const throw();
      /** There are an anchor and two neighbors given. This method searches
       *  for all neighbors, that are neighbors of first and second, and
       *  have a link to self and anchor.
       *
       *  Because of conflicts with collinear neighbors, the result is the
       *  'fewest collinear' neighbor pair.
       *
       *  \param Node given anchor
       *  \param Node first neighbor
       *  \param Node second neighbor
       *  \return NodeList above mentioned neighbor
       *  \sa find_common_neighbor_neighbors(),
       *    find_unique_neighbor_neighbors()
       */
      virtual const localization::NodeList find_common_neighbor_neighbors_opt(
            const shawn::Node&, const shawn::Node&, const shawn::Node&, double& )
         const throw();
      /** This method decides, which of given feasible solutions is the right
       *  one. The solutions are a result of trilateration with distances
       *  between self, two neighbors and an anchor.
       *
       *  The neighbor vote applies the same procedure with given \em third
       *  \em neighbors and each of both first mentioned neighbors. This
       *  results in at least two different localization::DistancePairs. Now
       *  the results are split into two parts. One with the distances, which
       *  are nearest to each other, and one with the others.\n
       *  The mean of first mentioned part should be the right solution.
       *
       *  Moreover, there are two checks to decide, whether the solution is
       *  valid or not. At first, if the nodes are collinear, it is hard to
       *  select the right alternative, because the difference in distances in
       *  both parts is very low. These cases are filtered out by the
       *  requirement, that the standard deviation in one part must be at most
       *  1/3rd of the standard deviation of the other part.\n
       *  Second, if there is one neighbor with incorrect information, this
       *  could result in two wrong votes. This case is filtered out by the
       *  requirement, that the standard deviation of selected part is at most
       *  5% of mean.
       *
       *  \param Node given anchor
       *  \param Node first neighbor
       *  \param Node second neighbor
       *  \param localization::DistancePair two feasible solutions
       *  \param localization::NodeList list of \em third \em neighbors
       *  \return Best fit distance of given DistancePair. If there is no
       *    decision or a check fails, method returns -1
       *  \sa common_neighbor()
       */
      virtual double neighbor_vote(
            const shawn::Node&, const shawn::Node&, const shawn::Node&,
            const localization::DistancePair&, const localization::NodeList& )
         const throw();
      /** This method decides, which of given feasible solutions is the right
       *  one. The solutions are a result of trilateration with distances
       *  between self, two neighbors and an anchor.
       *
       *  A third neighbor is taken, that has distance to both mentioned
       *  neighbors, self and anchor. Basic geometric reasoning leads to the
       *  right solution.
       *
       *  \param Node given anchor
       *  \param Node first neighbor
       *  \param Node second neighbor
       *  \param localization::DistancePair two feasible solutions
       *  \param localization::NodeList list of \em third \em neighbors
       *  \return Best fit distance of given DistancePair. If there is no
       *    decision, method returns -1
       *  \sa neighbor_vote()
       */
      virtual double common_neighbor(
            const shawn::Node&, const shawn::Node&, const shawn::Node&,
            const localization::DistancePair&, const localization::NodeList& )
         const throw();
      ///@}


      ///@name initial methods
      ///@{
      /** Read the given parameters, which have been set via simulator
       *  commands or configuration file.
       */
      virtual void init_parameters( void ) throw();
      ///@}


   private:

      enum EuclideanState
      {
         eu_init,
         eu_wait,
         eu_broadcast,
         eu_work,
         eu_finished
      };

      enum EuclideanCollinearCheckStd
      {
         eu_cc_std_lax,
         eu_cc_std_strict,
         eu_cc_std_none
      };

      enum EuclideanCollinearCheckNV
      {
         eu_cc_nv_lax,
         eu_cc_nv_strict,
         eu_cc_nv_none
      };

      enum EuclideanCollinearCheckCN
      {
         eu_cc_cn_lax,
         eu_cc_cn_strict,
         eu_cc_cn_none
      };

      enum EuclideanAlgo
      {
         eu_algo_normal,
         eu_algo_opt
      };

      enum EuclideanVote
      {
         eu_vote_nv,
         eu_vote_cn,
         eu_vote_nvcn,
         eu_vote_cnnv
      };

      EuclideanState state_;
      EuclideanCollinearCheckStd cc_std_;
      EuclideanCollinearCheckNV cc_nv_;
      EuclideanCollinearCheckCN cc_cn_;
      EuclideanAlgo algo_;
      EuclideanVote vote_;

      int last_useful_msg_;
      double col_measure_;

   };

}// namespace localization
#endif
#endif
/*-----------------------------------------------------------------------
 * Source  $Source: /cvs/shawn/shawn/apps/localization/modules/distance/localization_euclidean_module.h,v $
 * Version $Revision: 197 $
 * Date    $Date: 2008-04-29 17:40:51 +0200 (Tue, 29 Apr 2008) $
 *-----------------------------------------------------------------------
 * $Log: localization_euclidean_module.h,v $
 *-----------------------------------------------------------------------*/
