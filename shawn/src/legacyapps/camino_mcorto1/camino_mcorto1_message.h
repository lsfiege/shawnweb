#ifndef __SHAWN_LEGACYAPPS_CAMINO_MCORTO1_CAMINO_MCORTO1_MESSAGE_H
#define __SHAWN_LEGACYAPPS_CAMINO_MCORTO1_CAMINO_MCORTO1_MESSAGE_H
#include "_legacyapps_enable_cmake.h"
#ifdef ENABLE_CAMINO_MCORTO1

#include "sys/message.h"

namespace camino_mcorto1
{

   class camino_mcorto1Message
       : public shawn::Message
   {
   public:
	   camino_mcorto1Message();
	   camino_mcorto1Message(int);
	   virtual ~camino_mcorto1Message();
   };

}

#endif
#endif
