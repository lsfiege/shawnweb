#ifndef __SHAWN_LEGACYAPPS_CAMINO_MCORTO1_CAMINO_MCORTO1_PROCESSOR_H
#define __SHAWN_LEGACYAPPS_CAMINO_MCORTO1_CAMINO_MCORTO1_PROCESSOR_H
#include "_legacyapps_enable_cmake.h"
#ifdef ENABLE_CAMINO_MCORTO1

#include "sys/processor.h"
#include <set>

namespace camino_mcorto1
{

   class camino_mcorto1Processor
       : public shawn::Processor
   {
   public:
      camino_mcorto1Processor();
      virtual ~camino_mcorto1Processor();

      virtual void boot( void ) throw();
      virtual bool process_message( const shawn::ConstMessageHandle& ) throw();
      virtual void work( void ) throw();

   protected:
      int last_time_of_receive_;
      std::set<const shawn::Node*> neighbours_;
   };

}

#endif
#endif
