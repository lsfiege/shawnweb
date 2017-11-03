/************************************************************************
 ** This file is part of the network simulator Shawn.                  **
 ** Copyright (C) 2004-2007 by the SwarmNet (www.swarmnet.de) project  **
 ** Shawn is free software; you can redistribute it and/or modify it   **
 ** under the terms of the BSD License. Refer to the shawn-licence.txt **
 ** file in the root of the Shawn source tree for further details.     **
 ************************************************************************/

#include "sys/transm_models/zigbee_csma_transmission_model.h"
#include "sys/transm_models/zigbee_csma_transmission_model_factory.h"
#include "sys/transm_models/transmission_model_keeper.h"
#include "sys/simulation/simulation_controller.h"

namespace shawn
{

   ZigbeeCsmaTransmissionModelFactory::
   ZigbeeCsmaTransmissionModelFactory()
   {}
   // ----------------------------------------------------------------------
   ZigbeeCsmaTransmissionModelFactory::
   ~ZigbeeCsmaTransmissionModelFactory()
   {}
   // ----------------------------------------------------------------------
   std::string
   ZigbeeCsmaTransmissionModelFactory::
   name( void )
      const throw()
   {
      return std::string("zigbee_csma");
   }
   // ----------------------------------------------------------------------
   std::string
   ZigbeeCsmaTransmissionModelFactory::
   description( void ) 
      const throw()
   {
      return std::string("A ZigbeeCsmaTransmissionModel (\"zigbee_csma\") uses initial backoff, congestion backoff and contention window.");
   }
   // ----------------------------------------------------------------------
   TransmissionModel*
   ZigbeeCsmaTransmissionModelFactory::
   create( const SimulationController& )
      throw()
   {
      return new ZigbeeCsmaTransmissionModel;
   }

}

/*-----------------------------------------------------------------------
 * Source  $Source: /cvs/shawn/shawn/sys/transm_models/zigbee_csma_transmission_model_factory.cpp,v $
 * Version $Revision: 38 $
 * Date    $Date: 2007-06-08 14:30:12 +0200 (Fri, 08 Jun 2007) $
 *-----------------------------------------------------------------------
 * $Log: zigbee_csma_transmission_model_factory.cpp,v $
 *-----------------------------------------------------------------------*/
